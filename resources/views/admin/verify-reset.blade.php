@extends('admin.layout.app')

@section('title', 'Xác minh OTP & Đặt lại mật khẩu')

@section('content')
<div class="container mt-5">

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

    <div class="card shadow border-0 rounded-3 mx-auto" style="max-width: 500px;">
        <div class="card-body p-4">
            <h4 class="text-center text-primary mb-4">
                <i class="fa-solid fa-lock me-2"></i> Xác minh OTP & Đặt lại mật khẩu
            </h4>

            <form action="{{ route('password.verify-reset') }}" method="POST" id="verifyResetForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Mã OTP</label>
                    <input type="text" name="otp" class="form-control" placeholder="Nhập mã OTP" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route($authUser->role.'.accounts.profile', $authUser->id) }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-check me-1"></i> Xác nhận & Đổi mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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

    // Tự động ẩn alert sau 4 giây
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 4000);
});
</script>
@endpush
