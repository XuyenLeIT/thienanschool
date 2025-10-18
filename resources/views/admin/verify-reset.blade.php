<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh OTP & Đặt lại mật khẩu</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
@php
    // Lấy email từ session do controller sendOtp lưu
    $resetEmail = session('password_reset_email');
@endphp

<div class="container py-5">
    {{-- Thông báo --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 mx-auto" style="max-width: 480px;">
        <div class="card-body p-4">
            <h4 class="text-center text-primary mb-3">
                <i class="fa-solid fa-lock me-2"></i>
                Xác minh OTP & Đặt lại mật khẩu
            </h4>

            {{-- Hiển thị email đang reset --}}
            @if ($resetEmail)
                <p class="text-center text-muted mb-3">
                    Đặt lại mật khẩu cho: <strong>{{ $resetEmail }}</strong>
                </p>
            @endif

            <form action="{{ route('password.verify-reset') }}" method="POST" id="verifyResetForm">
                @csrf

                {{-- Email readonly --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $resetEmail ?? '' }}" readonly>
                </div>

                {{-- OTP --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Mã OTP</label>
                    <input type="text" name="otp" class="form-control"
                           placeholder="Nhập mã OTP" required>
                </div>

                {{-- Mật khẩu mới --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Nhập mật khẩu mới" required>
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="Nhập lại mật khẩu" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại đăng nhập
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-check me-1"></i> Xác nhận & Đổi mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('verifyResetForm');
    form.addEventListener('submit', function () {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Đang xử lý...
            `;
        }
    });

    // Ẩn alert sau 4 giây
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 4000);
});
</script>
</body>
</html>
