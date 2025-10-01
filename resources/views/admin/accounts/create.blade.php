@extends('admin.layout.app')
@section('title', 'Thêm Nhân viên')

@section('content')
    <div class="container">
        {{-- Header + Back --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Thêm Nhân viên</h3>
            <a href="{{ route($authUser->role.'.accounts.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route($authUser->role.'.accounts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                {{-- Avatar --}}
                <div class="col-md-6">
                    <label>Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Fullname --}}
                <div class="col-md-6">
                    <label>Họ tên</label>
                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="col-md-6">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="col-md-6">
                    <label>Chức vụ</label>
                    <select name="role" id="roleSelect" class="form-control">
                        <option value="">-- Chọn vai trò --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div class="col-md-6">
                    <label>Ngày bắt đầu</label>
                    <input type="date" name="startdate" class="form-control" value="{{ old('startdate') }}">
                    @error('startdate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Admin Approve --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="admin_approve" value="0">
                    <input type="checkbox" name="admin_approve" class="form-check-input me-2" id="adminApproveCheck"
                        value="1" {{ old('admin_approve', 0) ? 'checked' : '' }}
                        {{ $authUser->role !== 'admin' ? 'disabled' : '' }}>
                    <label class="form-check-label" for="adminApproveCheck">Admin duyệt</label>
                    @error('admin_approve')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" name="status" class="form-check-input me-2" id="statusCheck" value="1"
                        {{ old('status', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusCheck">Hoạt động</label>
                    @error('status')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Manage Class --}}
                <div class="col-md-6">
                    <label>Quản lý lớp</label>
                    <select name="classname" id="classname" class="form-control"
                        {{ old('role') !== 'teacher' ? 'disabled' : '' }}>
                        <option value="">-- Chọn lớp --</option>
                        @foreach ($classGrades as $code => $label)
                            <option value="{{ $code }}" {{ old('classname') == $code ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('classname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                {{-- Note --}}
                <div class="col-12">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-success" id="submitBtn">
                    <span id="btnText"><i class="fa-solid fa-plus"></i> Tạo mới</span>
                    <span id="btnLoading" class="d-none">
                        <i class="fas fa-spinner fa-spin"></i> Đang xử lý...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- JS enable/disable Manage Class --}}
    <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        form.addEventListener('submit', function() {
            // disable button
            submitBtn.disabled = true;
            // ẩn text cũ, hiện loading
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
        });

        // JS enable/disable Manage Class
        const roleSelect = document.getElementById('roleSelect');
        const manageClass = document.getElementById('classname');

        function toggleManageClass() {
            if (['teacher','nanny'].includes(roleSelect.value)) {
                manageClass.disabled = false;
            } else {
                manageClass.disabled = true;
                manageClass.value = '';
            }
        }

        roleSelect.addEventListener('change', toggleManageClass);
        toggleManageClass();
    </script>
@endsection
