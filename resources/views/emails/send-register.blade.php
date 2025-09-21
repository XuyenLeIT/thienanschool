<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px 20px;
        }

        .content h2 {
            color: #333;
            font-size: 20px;
        }

        .info {
            margin: 20px 0;
        }

        .info p {
            font-size: 16px;
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding: 15px;
            background-color: #f4f4f7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Chào mừng {{ $fullname }}!</h1>
        </div>

        <div class="content">

            <h2>Tài khoản của bạn đã được tạo thành công</h2>
            <div class="info">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Mật khẩu:</strong> {{ $password }}</p>
            </div>

            <a href="{{ url('/login') }}" class="button">Đăng nhập hệ thống</a>

            <p style="margin-top: 15px; color: #555;">Hãy đổi mật khẩu sau khi đăng nhập để bảo mật thông tin cá nhân.
            </p>
        </div>
    </div>
</body>

</html>
