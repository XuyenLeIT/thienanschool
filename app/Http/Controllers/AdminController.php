<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

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

        $user = User::where('email', $request->email)->first();

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
            return redirect()->route('manager.dashboard');
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
            $user = User::where('email', $email)->first();

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
}
