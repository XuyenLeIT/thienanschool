<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #FFD6D6 0%, #FFB347 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", sans-serif;
        }

        .login-card {
            max-width: 440px;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            background: #fff;
            position: relative;
        }

        .login-header {
            background: linear-gradient(90deg, #FFB347, #FCB53B);
            color: #fff;
            text-align: center;
            padding: 90px 20px 25px; /* 🔥 tăng padding-top để tránh chồng hình */
            position: relative;
        }

        .login-header img {
            width: 90px;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .login-header h3 {
            margin-top: 10px;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #FCB53B;
            box-shadow: 0 0 0 0.2rem rgba(252, 181, 59, 0.25);
        }

        .btn-primary {
            background: #FCB53B;
            border: none;
            border-radius: 30px;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #e89c0a;
        }

        .alert {
            border-radius: 10px;
        }

        a {
            color: #FCB53B;
            text-decoration: none;
        }

        a:hover {
            color: #e89c0a;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card login-card">
        <div class="login-header">
            <img src="https://cdn-icons-png.flaticon.com/512/3667/3667249.png" alt="login cartoon">
            <h3>Đăng nhập hệ thống</h3>
            <p>Chào mừng bạn quay lại 💖</p>
        </div>

        <div class="card-body p-4">
            {{-- ✅ Hiển thị thông báo tổng thể --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>🎉 Thành công!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Lỗi!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>⏳ Thông báo:</strong> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Hiển thị lỗi validate --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">📧 Địa chỉ Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn"
                        required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">🔒 Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('password.forgot-form') }}">Quên mật khẩu?</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
