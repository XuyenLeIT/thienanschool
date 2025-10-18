@extends('admin.layout.app')

@section('title', 'Quản lý tài khoản')

@section('content')
<div class="container mt-4">

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabs --}}
    <ul class="nav nav-tabs" id="accountTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">Cập nhật hồ sơ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#password" role="tab">Đổi mật khẩu</a>
        </li>
    </ul>

    <div class="tab-content border border-top-0 p-3 rounded-bottom shadow-sm bg-white">

        {{-- Tab 1 --}}
        <div class="tab-pane fade show active" id="profile" role="tabpanel">
            <h5 class="mb-3"><i class="fa-solid fa-user me-2"></i> Cập nhật hồ sơ</h5>
            <form method="POST" action="{{ route($authUser->role.'.accounts.update-profile') }}" enctype="multipart/form-data">
                @csrf
                 @method('PUT')
                <input type="hidden" name="active_tab" value="profile">

                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address', session('auth_user')->address ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" name="avatar" id="avatarInput" class="form-control">
                    <div class="mt-2">
                        <img id="avatarPreview"
                             src="{{ asset(session('auth_user')->avatar ?? 'default-avatar.png') }}"
                             class="rounded-circle border"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
                </button>
            </form>
        </div>

        {{-- Tab 2 --}}
        <div class="tab-pane fade" id="password" role="tabpanel">
            <h5 class="mb-3"><i class="fa-solid fa-key me-2"></i> Đổi mật khẩu</h5>
            <form method="POST" action="{{ route($authUser->role.'.accounts.change-password') }}">
                @csrf
                <input type="hidden" name="active_tab" value="password">

                <div class="mb-3">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-rotate me-1"></i> Đổi mật khẩu
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"]');
    let activeTabId = localStorage.getItem('activeTabId');

    // Lưu tab đang mở
    tabLinks.forEach(link => {
        link.addEventListener('shown.bs.tab', function (e) {
            localStorage.setItem('activeTabId', e.target.getAttribute('href'));
        });
    });

    // Ưu tiên session active_tab
    @if (session('active_tab'))
        activeTabId = "#{{ session('active_tab') }}";
        localStorage.setItem('activeTabId', activeTabId);
    @endif

    // Kích hoạt lại tab
    if (activeTabId) {
        const tabTrigger = document.querySelector(`[href="${activeTabId}"]`);
        if (tabTrigger) new bootstrap.Tab(tabTrigger).show();
    }

    // Preview avatar
    const avatarInput = document.getElementById('avatarInput');
    if (avatarInput) {
        avatarInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = ev => document.getElementById('avatarPreview').src = ev.target.result;
                reader.readAsDataURL(file);
            }
        });
    }

    // 🚀 Loading button khi submit form
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.setAttribute('data-original-text', btn.innerHTML);
                btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Đang xử lý...
                `;
            }
        });
    });

    // 🧩 Khi trang load lại (sau redirect), khôi phục nút về trạng thái ban đầu
    window.addEventListener('pageshow', function () {
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            if (btn.disabled) {
                btn.disabled = false;
                const originalText = btn.getAttribute('data-original-text');
                if (originalText) btn.innerHTML = originalText;
            }
        });
    });
});
</script>
@endsection
