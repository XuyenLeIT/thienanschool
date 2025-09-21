<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
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

        // lưu thông tin user vào session
        session(['user_id' => $user->id]);

        // điều hướng theo role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isManager()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
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
            'email' => 'required|email|exists:users,email'
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

            // Update mật khẩu
            $user->password = Hash::make($request->password);
            $user->save();

            // Xóa session
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
        $authUser = $request->get('auth_user');
        $accounts = Account::where('id', '!=', $authUser->id)->get();
        return view('admin.accounts.index', compact('accounts', 'authUser'));
    }

    public function create(Request $request)
    {
        $authUser = $request->get('auth_user');

        // Danh sách role có thể chọn
        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

        // Nếu user là manager, loại bỏ role manager và admin khỏi select
        if ($authUser->role === 'manager') {
            $roles = array_diff($roles, ['manager', 'admin']);
        }
        return view('admin.accounts.create', compact('roles', 'authUser'));
    }

    /**
     * Lưu account mới
     */
    public function store(Request $request)
    {
        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

        try {
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
            ]);

            $account = new Account();
            $account->fullname = $validated['fullname'];
            $account->email = $validated['email'];
            $account->phone = $validated['phone'] ?? null;
            $account->address = $validated['address'] ?? null;
            $account->role = $validated['role'];
            $account->password = Hash::make('123456');
            $account->startdate = $validated['startdate'] ?? null;
            $account->manage_class = $validated['role'] === 'teacher' ? ($validated['manage_class'] ?? null) : null;
            $account->note = $validated['note'] ?? null;
            $account->status = $validated['status'] ?? 0;
            $account->admin_approve = $validated['admin_approve'] ?? 0;
            $account->save();

            return redirect()->route('admin.accounts.index')
                ->with('success', 'Account tạo thành công.');

        } catch (\Throwable $e) {
            // Lưu log nếu muốn
            \Log::error('Lỗi tạo account: ' . $e->getMessage());

            // Quay lại form và hiển thị lỗi
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    /**
     * Form edit account
     */

    public function edit($id, Request $request)
    {
        $account = Account::findOrFail($id);

        // Lấy user hiện tại
        $authUser = $request->get('auth_user');
        // Danh sách role có thể chọn
        $roles = ['manager', 'teacher', 'kitchen', 'nanny', 'admin'];

        // Nếu user là manager, loại bỏ role manager và admin khỏi select
        if ($authUser->role === 'manager') {
            $roles = array_diff($roles, ['manager', 'admin']);
        }

        return view('admin.accounts.edit', compact('account', 'roles', 'authUser'));
    }



    /**
     * Update account
     */
    public function update(Request $request, $id)
    {
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
        ]);

        $account->fullname = $validated['fullname'];
        $account->email = $validated['email'];
        $account->phone = $validated['phone'];
        $account->address = $validated['address'];
        $account->role = $validated['role'];
        if (!empty($validated['password'])) {
            $account->password = Hash::make($validated['password']);
        }
        $account->startdate = $validated['startdate'] ?? null;
        $account->manage_class = $validated['manage_class'] ?? null;
        $account->note = $validated['note'] ?? null;
        $account->status = $validated['status'] ?? 0;
        $account->admin_approve = $validated['admin_approve'] ?? 0;
        $account->save();

        return redirect()->route('admin.accounts.index')
            ->with('success', 'Account cập nhật thành công.');
    }

    /**
     * ban account
     */
    public function ban(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);

            // Kiểm tra quyền
            $authUser = $request->get('auth_user');
            if ($authUser->role === 'manager' && in_array($account->role, ['admin', 'manager'])) {
                return back()->with('error', 'Bạn không có quyền vô hiệu hóa account này.');
            }

            // Toggle status
            $account->status = $account->status ? 0 : 1;
            $account->save();

            $message = $account->status ? 'Account đã được kích hoạt.' : 'Account đã bị vô hiệu hóa.';
            return redirect()->route('admin.accounts.index')->with('success', $message);
        } catch (\Throwable $e) {
            \Log::error('Lỗi khi thay đổi trạng thái account: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


}
