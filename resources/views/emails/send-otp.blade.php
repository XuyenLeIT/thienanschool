<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Mã OTP xác nhận</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0;">

    <table align="center" cellpadding="0" cellspacing="0" width="600"
        style="background: #ffffff; margin: 30px auto; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
        <tr>
            <td style="background: #0d6efd; padding: 20px; text-align: center; color: #fff;">
                <h2 style="margin: 0; font-size: 22px;">Thiên Ân School</h2>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px; color: #333333;">
                <h3 style="margin-top: 0; font-size: 20px;">Xin chào {{ $email }},</h3>
                <p style="font-size: 15px; line-height: 1.6;">
                    Bạn vừa yêu cầu <strong>đặt lại mật khẩu</strong>. Đây là mã OTP của bạn:
                </p>

                <div style="font-size: 28px; font-weight: bold; color: #0d6efd; text-align: center; margin: 25px 0; letter-spacing: 4px;">
                    {{ $otp }}
                </div>

                <p style="font-size: 15px; line-height: 1.6;">
                    Mã OTP có hiệu lực trong vòng <strong>5 phút</strong>. <br>
                    Nếu bạn không thực hiện yêu cầu này, vui lòng <span style="color: red; font-weight: bold;">bỏ qua email</span>.
                </p>

                <p style="margin-top: 30px; font-size: 14px; color: #555;">
                    Trân trọng, <br>
                    <strong>Thiên Ân School</strong>
                </p>
            </td>
        </tr>

        <tr>
            <td style="background: #f1f1f1; text-align: center; padding: 15px; font-size: 12px; color: #666;">
                © 2025 Thiên Ân School. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
