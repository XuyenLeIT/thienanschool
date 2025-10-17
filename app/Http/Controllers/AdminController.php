<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\Account;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
        $studentCount = Student::where('status', 2)->count();

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
            ->where('status', 2)->get() : null;

        // Lấy điểm danh theo ngày
        $attendances = $classname ? Attendance::where('classname', $classname)
            ->where('date', $selectedDate)
            ->get() : null;

        return view('admin.dashboard', compact(
            'authUser',
            'classname',
            'teacherCount',
            'staffCount',
            'studentCount',
            'classList',
            'classStudentCounts',
            'selectedDate',
            'students',
            'attendances',
            'statusFilter',
            'from',
            'to'
        ));
    }

    /** ------------------ API THỐNG KÊ HỌC SINH ------------------ **/
    public function stats(Request $request, $studentId)
    {
        $from = $request->from ?? now()->startOfMonth()->toDateString();
        $to   = $request->to ?? now()->toDateString();
        $classname = $request->classname;

        $query = Attendance::where('student_id', $studentId)
            ->whereBetween('date', [$from, $to]);

        if ($classname) {
            $query->where('classname', $classname);
        }

        $records = $query->get(['date', 'status', 'note']);

        return response()->json([
            'presentDays' => $records->where('status', 'present')->count(),
            'absentDays'  => $records->where('status', 'absent')->count(),
            'records'     => $records->map(fn($item) => [
                'date'   => (string) $item->date, // an toàn hơn
                'status' => $item->status,
                'note'   => $item->note,
            ]),
        ]);
    }



    /** ------------------ LOGIN / LOGOUT ------------------ **/
    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Account::where('email', $request->email)->first();

        if (!$user || !$user->checkPassword($request->password)) {
            return back()->withErrors(['email' => 'Sai email hoặc mật khẩu.']);
        }

        if (!$user->status) {
            return back()->withErrors(['email' => 'Tài khoản bị khóa hoặc chưa kích hoạt']);
        }

        session(['auth_user' => $user]);

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
    public function showForgotPassword()
    {
        return view('admin.forgot-password');
    }
    public function showForgotForm()
    {
        return view('admin.forgot');
    }

    public function sendOtp(Request $request)
    {
        try {
            // Xác thực email
            $validated = $request->validate([
                'email' => 'required|email|exists:accounts,email',
            ], [
                'email.exists' => 'Email không tồn tại trong hệ thống.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Định dạng email không hợp lệ.',
            ]);

            // Tạo OTP
            $otp = rand(100000, 999999);

            // Lưu OTP vào session (hoặc DB nếu muốn bền hơn)
            session([
                'password_reset_email' => $validated['email'],
                'password_reset_otp' => $otp,
                'password_reset_expires' => Carbon::now()->addMinutes(5),
            ]);

            // Gửi mail
            Mail::to($validated['email'])->send(new SendOtpMail($otp, $validated['email']));

            // Nếu gửi mail thành công → chuyển sang view verify
            return redirect()
                ->route('password.verify-reset-form')
                ->with('success', 'Mã OTP đã gửi, vui lòng kiểm tra email!');
        } catch (ValidationException $e) {
            // Trả về lỗi validate + giữ lại tab "reset"
            return back()
                ->withErrors($e->errors())
                ->with('active_tab', 'reset');
        } catch (\Exception $ex) {
            // Nếu có lỗi khác (gửi mail fail, v.v.)
            Log::error('Gửi OTP thất bại: ' . $ex->getMessage());

            return back()
                ->with('error', 'Không thể gửi OTP. Vui lòng thử lại sau.')
                ->with('active_tab', 'reset');
        }
    }

    public function showVerifyAndResetForm()
    {
        if (!session()->has('password_reset_email')) {
            return redirect()->route('password.forgot-form')
                ->withErrors(['email' => 'Bạn cần nhập email trước.']);
        }
        return view('admin.verify-reset');
    }

    public function verifyAndReset(Request $request)
    {
        // 1️⃣ Xác thực dữ liệu đầu vào
        $request->validate([
            'otp' => 'required|numeric',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()   // Có cả chữ hoa và chữ thường
                    ->letters()     // Có chữ cái
                    ->numbers()     // Có số
                    ->symbols(),    // Có ký tự đặc biệt
            ],
        ], [
            // ----- Thông báo cho OTP -----
            'otp.required' => 'Vui lòng nhập mã OTP.',
            'otp.numeric' => 'Mã OTP chỉ được phép chứa số.',

            // ----- Thông báo cho mật khẩu -----
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.mixed' => 'Mật khẩu phải chứa cả chữ hoa và chữ thường.',
            'password.letters' => 'Mật khẩu phải chứa ít nhất một chữ cái.',
            'password.numbers' => 'Mật khẩu phải chứa ít nhất một chữ số.',
            'password.symbols' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt.',
        ]);


        // 2️⃣ Kiểm tra OTP trong session
        $sessionOtp = session('password_reset_otp');
        $sessionEmail = session('password_reset_email');
        $sessionExpires = session('password_reset_expires');

        if (!$sessionOtp || !$sessionEmail || !$sessionExpires) {
            return back()->withErrors(['otp' => 'Phiên đặt lại mật khẩu đã hết hạn. Vui lòng gửi lại mã OTP.']);
        }

        // 3️⃣ So sánh OTP và thời gian hết hạn
        if ($request->otp != $sessionOtp || Carbon::now()->gte($sessionExpires)) {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
        }

        // 4️⃣ Kiểm tra tài khoản
        $user = Account::where('email', $sessionEmail)->first();
        if (!$user) {
            return redirect()->route('password.forgot-form')
                ->withErrors(['email' => 'Không tìm thấy tài khoản tương ứng với email này.']);
        }

        // 5️⃣ Cập nhật mật khẩu mới (phải mã hoá)
        $user->password = $request->password;
        $user->save();

        // 6️⃣ Xoá session OTP sau khi thành công
        session()->forget(['password_reset_email', 'password_reset_otp', 'password_reset_expires']);

        // 7️⃣ Chuyển hướng sau khi đặt lại mật khẩu
        return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập.');
    }

    /** ------------------ PROFILE / CHANGE PASSWORD ------------------ **/
    public function profile(Request $request)
    {
        $authUser = $request->session()->get('auth_user');
        $account = Account::findOrFail($authUser->id);
        return view('admin.accounts.profile', compact('account', 'authUser'));
    }

    public function updateProfile(Request $request)
    {
        $user = session('auth_user');
        if (!$user) return back()->with('error', 'Không tìm thấy thông tin người dùng trong session.')
            ->with('active_tab', 'profile');

        $validated = $request->validate([
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $account = Account::findOrFail($user->id);
        $account->address = $validated['address'] ?? $account->address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(public_path('avatars'))) mkdir(public_path('avatars'), 0755, true);
            $file->move(public_path('avatars'), $filename);
            if ($account->avatar && file_exists(public_path($account->avatar))) unlink(public_path($account->avatar));
            $account->avatar = 'avatars/' . $filename;
        }

        $account->save();
        session(['auth_user' => $account]);

        return back()->with([
            'success' => 'Cập nhật thông tin thành công!',
            'active_tab' => 'profile',
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols(),
            ],
        ], [
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $authUser = session('auth_user');

        if (!$authUser || !$authUser->checkPassword($request->current_password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])
                ->with('active_tab', 'password');
        }

        $authUser->password = $request->new_password;
        $authUser->save();

        return back()->with([
            'success' => 'Đổi mật khẩu thành công!',
            'active_tab' => 'password',
        ]);
    }
}
