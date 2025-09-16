<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác minh OTP & Đặt lại mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 text-primary">🔐 Xác minh OTP & Đặt lại mật khẩu</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('password.verify-reset') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã OTP</label>
                            <input type="text" name="otp" class="form-control" placeholder="Nhập mã OTP"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Mật khẩu mới</label>
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Xác nhận mật khẩu" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Xác nhận & Đổi mật khẩu
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3 text-muted">© 2025 Thiên Ân School</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
