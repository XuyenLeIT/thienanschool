<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\Account;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /** ------------------ DASHBOARD ------------------ **/
    public function index(Request $request)
    {
        $authUser = session('auth_user');
        $classname = $request->classname ?? ($authUser->classname ?? null);

        // Tổng số nhân sự
        $teacherCount = Account::where('role', 'teacher')->count();
        $staffCount = Account::where('role', '!=', 'teacher')->count();

        // Tổng số học sinh
        $studentCount = Student::where('status', 1)->count();

        // Danh sách các lớp (code => tên hiển thị)
        $classList = Student::$classGrades;

        // Số học sinh từng lớp
        $classStudentCounts = [];
        foreach ($classList as $code => $label) {
            $classStudentCounts[$code] = Student::where('classname', $code)
                ->where('status', 1)
                ->count();
        }

        // Ngày chọn để xem điểm danh
        $selectedDate = $request->date ?? now()->toDateString();
        $statusFilter = $request->status_filter ?? 'all';
        $from = $request->from ?? now()->subMonth()->toDateString();
        $to = $request->to ?? now()->toDateString();

        // Lấy học sinh theo lớp
        $students = $classname ? Student::where('classname', $classname)
            ->where('status', 1)->get() : null;

        // Lấy điểm danh theo ngày
        $attendances = $classname ? Attendance::where('classname', $classname)
            ->where('date', $selectedDate)
            ->get() : null;

        return view('admin.dashboard', compact(
            'authUser', 'classname', 'teacherCount', 'staffCount', 'studentCount',
            'classList', 'classStudentCounts', 'selectedDate', 'students', 'attendances',
            'statusFilter', 'from', 'to'
        ));
    }

    /** ------------------ API THỐNG KÊ HỌC SINH ------------------ **/
    public function stats(Request $request, $studentId)
    {
        $from = $request->from ?? now()->startOfMonth()->toDateString();
        $to = $request->to ?? now()->toDateString();
        $classname = $request->classname;

        $query = Attendance::where('student_id', $studentId)->whereBetween('date', [$from, $to]);
        if ($classname) $query->where('classname', $classname);

        $records = $query->get();

        return response()->json([
            'presentDays' => $records->where('status', 'present')->count(),
            'absentDays' => $records->where('status', 'absent')->count(),
        ]);
    }

    /** ------------------ LOGIN / LOGOUT ------------------ **/
    public function login() { return view('admin.login'); }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = Account::where('email', $request->email)->first();

        if (!$user || !$user->checkPassword($request->password)) {
            return back()->withErrors(['email'=>'Sai email hoặc mật khẩu.']);
        }

        if (!$user->status) {
            return back()->withErrors(['email'=>'Tài khoản bị khóa hoặc chưa kích hoạt']);
        }

        session(['auth_user'=>$user]);

        // Điều hướng theo role
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        if ($user->isManager()) return redirect()->route('manager.dashboard');
        if ($user->isTeacher()) return redirect()->route('teacher.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('auth_user');
        return redirect()->route('login');
    }

    /** ------------------ QUÊN MẬT KHẨU ------------------ **/
    public function showForgotPassword() { return view('admin.forgot-password'); }
    public function showForgotForm() { return view('admin.forgot'); }

    public function sendOtp(Request $request)
    {
        $request->validate(['email'=>'required|email|exists:accounts,email']);
        $otp = rand(100000,999999);

        session([
            'password_reset_email'=>$request->email,
            'password_reset_otp'=>$otp,
            'password_reset_expires'=>Carbon::now()->addMinutes(5),
        ]);

        Mail::to($request->email)->send(new SendOtpMail($otp,$request->email));

        return redirect()->route('password.verify-reset-form')
            ->with('success','Mã OTP đã gửi, vui lòng kiểm tra email!');
    }

    public function showVerifyAndResetForm()
    {
        if (!session()->has('password_reset_email')) {
            return redirect()->route('password.forgot-form')
                ->withErrors(['email'=>'Bạn cần nhập email trước.']);
        }
        return view('admin.verify-reset');
    }

    public function verifyAndReset(Request $request)
    {
        $request->validate([
            'otp'=>'required|numeric',
            'password'=>'required|min:6|confirmed',
        ]);

        if (session('password_reset_otp') == $request->otp
            && Carbon::now()->lt(session('password_reset_expires'))) 
        {
            $email = session('password_reset_email');
            $user = Account::where('email',$email)->first();
            if (!$user) {
                return redirect()->route('password.forgot-form')
                    ->withErrors(['email'=>'Không tìm thấy tài khoản.']);
            }

            $user->password = $request->password;
            $user->save();

            session()->forget(['password_reset_email','password_reset_otp','password_reset_expires']);

            return redirect()->route('login')
                ->with('success','Đặt lại mật khẩu thành công! Vui lòng đăng nhập.');
        }

        return back()->withErrors(['otp'=>'Mã OTP không hợp lệ hoặc đã hết hạn.']);
    }

    /** ------------------ PROFILE / CHANGE PASSWORD ------------------ **/
    public function profile(Request $request)
    {
        $authUser = $request->session()->get('auth_user');
        $account = Account::findOrFail($authUser->id);
        return view('admin.accounts.profile', compact('account','authUser'));
    }

    public function updateProfile(Request $request)
    {
        $user = session('auth_user');
        if (!$user) return back()->with('error','Không tìm thấy thông tin người dùng trong session.');

        $validated = $request->validate([
            'address'=>'nullable|string|max:255',
            'avatar'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $account = Account::findOrFail($user->id);
        $account->address = $validated['address'] ?? $account->address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            if (!file_exists(public_path('avatars'))) mkdir(public_path('avatars'),0755,true);
            $file->move(public_path('avatars'),$filename);
            if ($account->avatar && file_exists(public_path($account->avatar))) unlink(public_path($account->avatar));
            $account->avatar = 'avatars/'.$filename;
        }

        $account->save();
        session(['auth_user'=>$account]);

        return back()->with('success','Cập nhật thông tin thành công!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required|min:6|confirmed',
        ]);

        $authUser = session('auth_user');

        if (!$authUser || !$authUser->checkPassword($request->current_password)) {
            return back()->withErrors(['current_password'=>'Mật khẩu hiện tại không đúng.']);
        }

        $authUser->password = $request->new_password;
        $authUser->save();

        return back()->with('success','Đổi mật khẩu thành công!');
    }
}
