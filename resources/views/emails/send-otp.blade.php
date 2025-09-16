<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Mã OTP xác nhận</title>
</head>

<body>
    <h2>Xin chào {{ $email }}</h2>
    <p>Bạn vừa yêu cầu đặt lại mật khẩu. Đây là mã OTP của bạn:</p>

    <div style="font-size: 24px; font-weight: bold; color: #2c3e50; margin: 15px 0;">
        {{ $otp }}
    </div>

    <p>Mã OTP có hiệu lực trong vòng <strong>5 phút</strong>.
        Nếu bạn không thực hiện yêu cầu này, hãy bỏ qua email này.</p>

    <br>
    <p>Trân trọng,<br><strong>Thiên Ân School</strong></p>
</body>

</html>
