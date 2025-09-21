@extends('admin.layout.app')
@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container my-4">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if ($account->avatar)
                            <img id="avatarPreview" src="{{ asset($account->avatar) }}" class="rounded-circle shadow" width="120" height="120" alt="Avatar">
                        @else
                            <img id="avatarPreview" src="https://via.placeholder.com/120x120?text=Avatar" class="rounded-circle shadow" width="120" height="120" alt="Avatar">
                        @endif
                    </div>
                    <h4>{{ $account->fullname }}</h4>
                    <p class="text-muted mb-1">{{ ucfirst($account->role) }}</p>
                    <span class="badge {{ $account->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $account->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                        <i class="fa-solid fa-id-card me-2"></i> Thông tin chung
                    </a>
                    <a href="#password" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="fa-solid fa-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="#reset" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="fa-solid fa-user-lock me-2"></i> Reset mật khẩu
                    </a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body tab-content">

                    {{-- Tab Info --}}
                    <div class="tab-pane fade show active" id="info">
                        <h5 class="mb-3"><i class="fa-solid fa-id-card me-2"></i> Cập nhật thông tin</h5>
                        <form method="POST" action="{{ route('admin.accounts.update-profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Họ và tên</label>
                                        <input type="text" name="fullname" readonly class="form-control" value="{{ old('fullname', $account->fullname) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" readonly name="phone" class="form-control" value="{{ old('phone', $account->phone) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $account->address) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startdate" class="form-label">Ngày bắt đầu</label>
                                        <input type="date" readonly name="startdate" class="form-control" value="{{ old('startdate', $account->startdate?->format('Y-m-d')) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="avatarInput" class="form-label">Ảnh đại diện</label>
                                        <input type="file" id="avatarInput" name="avatar" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select name="status" disabled class="form-select">
                                            <option value="1" {{ $account->status ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$account->status ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Các field không cho update --}}
                            <p><strong>Email:</strong> {{ $account->email }}</p>
                            <p><strong>Manage Class:</strong> {{ $account->manage_class ?? '-' }}</p>
                            <p><strong>Note:</strong> {{ $account->note ?? '-' }}</p>

                            @if ($account->reason_ban)
                                <p class="text-danger"><strong>Lý do ban:</strong> {{ $account->reason_ban }}</p>
                            @endif

                            <button type="submit" class="btn btn-success mt-3">
                                <i class="fa-solid fa-save me-1"></i> Cập nhật thông tin
                            </button>
                        </form>
                    </div>

                    {{-- Tab Change Password --}}
                    <div class="tab-pane fade" id="password">
                        <h5 class="mb-3"><i class="fa-solid fa-key me-2"></i> Đổi mật khẩu</h5>
                        <form method="POST" action="{{ route('admin.accounts.change-password') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-1"></i> Cập nhật mật khẩu
                            </button>
                        </form>
                    </div>

                    {{-- Tab Reset Password --}}
                    <div class="tab-pane fade" id="reset">
                        <h5 class="mb-3"><i class="fa-solid fa-user-lock me-2"></i> Reset mật khẩu</h5>
                        <form method="POST" action="{{ route('password.send-otp') }}">
                            @csrf
                            <p>Bạn có chắc muốn reset mật khẩu của <strong>{{ $account->fullname }}</strong> không?</p>
                            <input type="hidden" name="email" value="{{ $account->email }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-rotate-left me-1"></i> Reset mật khẩu
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('avatarInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById('avatarPreview').setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
