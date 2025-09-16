<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #ffb6c1 0%, #c77575 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", sans-serif;
        }

        .login-card {
            max-width: 420px;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            background: #fff;
        }

        .login-header {
            background: #FCB53B;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .login-header h3 {
            margin: 0;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #FCB53B;
            box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
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
            background: #b02a6c;
        }

        a {
            color: #FCB53B;
        }

        a:hover {
            color: #b02a6c;
        }
    </style>
</head>

<body>
    <div class="card login-card">
        <div class="login-header">
            <h3>Đăng nhập</h3>
            <p>Chào mừng bạn quay lại 💖</p>
        </div>
        <div class="card-body p-4">

            {{-- Hiển thị lỗi đăng nhập --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                        required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>

            {{-- Link quên mật khẩu --}}
            <div class="text-center mt-3">
                <a href="{{ route('password.forgot-form') }}">Quên mật khẩu?</a>
            </div>
        </div>
    </div>
</body>

</html>
