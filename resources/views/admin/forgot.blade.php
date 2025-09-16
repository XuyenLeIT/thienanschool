<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quên mật khẩu</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary">Quên mật khẩu</h3>

            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
              <div class="alert alert-danger small">{{ $errors->first() }}</div>
            @endif
            {{-- Hiển thị thông báo --}}
            @if (session('success'))
              <div class="alert alert-success small">{{ session('success') }}</div>
            @endif

            <form id="forgotForm" action="{{ route('password.send-otp') }}" method="POST" novalidate>
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email của bạn</label>
                <input type="email" name="email" id="email" class="form-control rounded-3" placeholder="Nhập email" required>
              </div>
              <div class="d-grid">
                <button id="submitBtn" type="submit" class="btn btn-primary rounded-3">
                  <i class="bi bi-send me-1"></i> Gửi OTP
                </button>
              </div>
            </form>

            <div class="text-center mt-3">
              <a href="{{ route('login') }}" class="text-decoration-none small text-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại đăng nhập
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById('forgotForm').addEventListener('submit', function () {
      let btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Đang gửi...';
    });
  </script>
</body>
</html>
