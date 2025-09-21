<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Mail\SendOtpMail;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

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
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa hoặc chưa kích hoạt']);
        }

        // ✅ Lưu nguyên user vào session
        session(['auth_user' => $user]);

        // Điều hướng theo role
        if ($user->isAdmin() || $user->isManager()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('auth_user');
        return redirect()->route('login');
    }

    // Hiển thị form nhập email
    public function showForgotPassword()
    {
        return view('admin.forgot-password');
    }

    // Form quên mật khẩu (nhập email)
    public function showForgotForm()
    {
        return view('admin.forgot');
    }

    // Gửi OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:accounts,email'
        ]);

        $otp = rand(100000, 999999);

        // Lưu OTP vào session
        session([
            'password_reset_email' => $request->email,
            'password_reset_otp' => $otp,
            'password_reset_expires' => Carbon::now()->addMinutes(5),
        ]);

        // Gửi OTP qua mail
        Mail::to($request->email)->send(new SendOtpMail($otp, $request->email));

        return redirect()->route('password.verify-reset-form')
            ->with('success', 'Mã OTP đã được gửi vào email. Vui lòng kiểm tra hộp thư!');
    }

    // Form nhập OTP + password mới
    public function showVerifyAndResetForm()
    {
        if (!session()->has('password_reset_email')) {
            return redirect()->route('password.forgot-form')->withErrors(['email' => 'Bạn cần nhập email trước.']);
        }

        return view('admin.verify-reset');
    }

    // Xác minh OTP + reset password
    public function verifyAndReset(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ]);

        if (
            session('password_reset_otp') == $request->otp &&
            Carbon::now()->lt(session('password_reset_expires'))
        ) {
            $email = session('password_reset_email');
            $user = Account::where('email', $email)->first();

            if (!$user) {
                return redirect()->route('password.forgot-form')
                    ->withErrors(['email' => 'Không tìm thấy tài khoản.']);
            }

            $user->password = $request->password;
            $user->save();

            // Xóa session reset password
            session()->forget([
                'password_reset_email',
                'password_reset_otp',
                'password_reset_expires',
            ]);

            return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập.');
        }

        return back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
    }

    public function listAccount(Request $request)
    {
        $authUser = $request->session()->get('auth_user');
        $accounts = Account::where('id', '!=', $authUser->id)->get();

        return view('admin.accounts.index', compact('accounts', 'authUser'));
    }

    public function create(Request $request)
    {
        $authUser = $request->session()->get('auth_user');

        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

        if ($authUser->role === 'manager') {
            $roles = array_diff($roles, ['manager', 'admin']);
        }

        return view('admin.accounts.create', compact('roles', 'authUser'));
    }

    private function generateRandomPassword($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $maxIndex)];
        }

        return $password;
    }

    public function store(Request $request)
    {
        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => ['required', Rule::in($roles)],
            'startdate' => 'nullable|date',
            'manage_class' => 'nullable|string|max:50',
            'note' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'admin_approve' => 'nullable|boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $account = new Account();

            // Avatar
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('avatars'), $filename);
                $account->avatar = 'avatars/' . $filename;
            }

            // Sinh password ngẫu nhiên
            $randomPassword = $this->generateRandomPassword(8);
            $account->fullname = $validated['fullname'];
            $account->email = $validated['email'];
            $account->phone = $validated['phone'] ?? null;
            $account->address = $validated['address'] ?? null;
            $account->role = $validated['role'];
            $account->startdate = $validated['startdate'] ?? null;
            $account->manage_class = $validated['role'] === 'teacher'
                ? ($validated['manage_class'] ?? null)
                : null;
            $account->note = $validated['note'] ?? null;
            $account->status = $validated['status'] ?? 0;
            $account->admin_approve = $validated['admin_approve'] ?? 0;

            // ✅ Mutator sẽ hash
            $account->password = $randomPassword;

            $account->save();

            // Gửi mail
            Mail::to($account->email)->send(
                new RegisterMail($account->fullname, $account->email, $randomPassword)
            );

            DB::commit();

            return redirect()->route('admin.accounts.index')
                ->with('success', 'Account tạo thành công và email đã được gửi.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Lỗi tạo account hoặc gửi mail: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        $account = Account::findOrFail($id);
        $authUser = $request->session()->get('auth_user');

        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];
        if ($authUser->role === 'manager') {
            $roles = array_diff($roles, ['manager', 'admin']);
        }

        return view('admin.accounts.edit', compact('account', 'roles', 'authUser'));
    }

    public function update(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);
            $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('accounts')->ignore($account->id)],
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'role' => ['required', Rule::in($roles)],
                'password' => 'nullable|string|min:6|confirmed',
                'startdate' => 'nullable|date',
                'manage_class' => 'nullable|string|max:50',
                'note' => 'nullable|string|max:255',
                'status' => 'nullable|boolean',
                'admin_approve' => 'nullable|boolean',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $account->fullname = $validated['fullname'];
            $account->email = $validated['email'];
            $account->phone = $validated['phone'] ?? null;
            $account->address = $validated['address'] ?? null;
            $account->role = $validated['role'];

            if (!empty($validated['password'])) {
                $account->password = $validated['password']; // Mutator sẽ hash
            }

            $account->startdate = $validated['startdate'] ?? null;
            $account->manage_class = $validated['manage_class'] ?? null;
            $account->note = $validated['note'] ?? null;
            $account->status = $validated['status'] ?? 0;
            $account->admin_approve = $validated['admin_approve'] ?? 0;

            // Avatar
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();

                if (!file_exists(public_path('avatars'))) {
                    mkdir(public_path('avatars'), 0755, true);
                }

                $file->move(public_path('avatars'), $filename);

                if ($account->avatar && file_exists(public_path($account->avatar))) {
                    unlink(public_path($account->avatar));
                }

                $account->avatar = 'avatars/' . $filename;
            }

            $account->save();

            return redirect()->route('admin.accounts.index')
                ->with('success', 'Account cập nhật thành công.');
        } catch (\Throwable $e) {
            \Log::error('Lỗi cập nhật account: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    // Update profile (ngoại trừ email, manage_class, note)
 public function updateProfile(Request $request)
{
    try {
        $user = session('auth_user');
        if (!$user) {
            return back()->with('error', 'Không tìm thấy thông tin người dùng trong session.');
        }

        $validated = $request->validate([
            'address' => 'nullable|string|max:255',
            'avatar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $account = Account::findOrFail($user->id);

        // Update address
        $account->address = $validated['address'] ?? $account->address;

        // Upload avatar nếu có
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Tạo thư mục nếu chưa có
            if (!file_exists(public_path('avatars'))) {
                mkdir(public_path('avatars'), 0755, true);
            }

            $file->move(public_path('avatars'), $filename);

            // Xóa avatar cũ
            if ($account->avatar && file_exists(public_path($account->avatar))) {
                unlink(public_path($account->avatar));
            }

            $account->avatar = 'avatars/' . $filename;
        }

        // Lưu lại
        $account->save();

        // Cập nhật session
        session(['auth_user' => $account]);

        return back()->with('success', 'Cập nhật thông tin thành công!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Nếu validate lỗi thì trả về cùng lỗi
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        // Bắt mọi lỗi khác
        return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
    }
}

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Kiểm tra mật khẩu cũ
        $authUser = $request->get('auth_user');

        if (!$authUser || !$authUser->checkPassword($request->current_password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }


        // Cập nhật mật khẩu mới
        $authUser->password = $request->new_password;
        $authUser->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
    public function ban(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);
            $authUser = $request->session()->get('auth_user');

            if ($authUser->role === 'manager' && in_array($account->role, ['admin', 'manager'])) {
                return back()->with('error', 'Bạn không có quyền vô hiệu hóa account này.');
            }

            $reason = $request->input('reason');
            if ($reason === 'Khác') {
                $reason = $request->input('other_reason') ?? 'Không rõ';
            }

            $account->status = $account->status ? 0 : 1;

            if ($account->status == 0) {
                $account->reason_ban = $reason;
            } else {
                $account->reason_ban = null;
            }

            $account->save();

            $message = $account->status ? 'Account đã được kích hoạt.' : 'Account đã bị vô hiệu hóa.';
            return redirect()->route('admin.accounts.index')->with('success', $message);
        } catch (\Throwable $e) {
            \Log::error('Lỗi khi thay đổi trạng thái account: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);
        return view('admin.accounts.show', compact('account'));
    }

    public function profile(Request $request)
    {
        $authUser = $request->session()->get('auth_user');
        $account = Account::findOrFail($authUser->id);

        return view('admin.accounts.profile', compact('account', 'authUser'));
    }
}
