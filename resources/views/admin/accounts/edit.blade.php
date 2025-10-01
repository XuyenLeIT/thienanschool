@extends('admin.layout.app')
@section('title', 'Edit Nhân viên')

@section('content')
    <div class="container">
        {{-- Header + Back --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Nhân viên: {{ $account->fullname }}</h3>
            <a href="{{ route($authUser->role . '.accounts.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back
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

        <form action="{{ route($authUser->role . '.accounts.update', $account->id) }}" method="POST"
            enctype="multipart/form-data" id="accountForm">
            @csrf
            @method('PUT')

            <div class="row g-3">
                {{-- Avatar --}}
                <div class="col-md-6">
                    <label>Avatar</label>
                    <div class="mb-2">
                        @if ($account->avatar)
                            <img src="{{ asset($account->avatar) }}" alt="Avatar" class="rounded-circle" width="80"
                                height="80">
                        @else
                            <i class="fa-solid fa-user fa-3x text-secondary"></i>
                        @endif
                    </div>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Fullname --}}
                <div class="col-md-6">
                    <label>Họ tên</label>
                    <input type="text" name="fullname" class="form-control"
                        value="{{ old('fullname', $account->fullname) }}" required>
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" readonly name="email" class="form-control"
                        value="{{ old('email', $account->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $account->phone) }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="col-md-6">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address', $account->address) }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="col-md-6">
                    <label>Chức vụ</label>
                    <select name="role" id="roleSelect" class="form-control">
                        @foreach ($roles as $role)
                            @php
                                $disabled = '';
                                if ($authUser->role === 'manager' && in_array($role, ['admin', 'manager'])) {
                                    $disabled = 'disabled';
                                }
                            @endphp
                            <option value="{{ $role }}"
                                {{ old('role', $account->role) == $role ? 'selected' : '' }} {{ $disabled }}>
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
                    <input type="date" name="startdate" class="form-control"
                        value="{{ old('startdate', $account->startdate ? $account->startdate->format('Y-m-d') : '') }}">
                    @error('startdate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Admin Approve --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="admin_approve" value="0">
                    <input type="checkbox" name="admin_approve" class="form-check-input me-2" id="adminApproveCheck"
                        value="1" {{ old('admin_approve', $account->admin_approve) ? 'checked' : '' }}
                        {{ $authUser->role !== 'admin' ? 'disabled' : '' }}>
                    <label class="form-check-label" for="adminApproveCheck">
                        Admin duyệt
                        @if ($account->admin_approve)
                            <span class="text-success">(Đã duyệt)</span>
                        @endif
                    </label>
                    @error('admin_approve')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" name="status" class="form-check-input me-2" id="statusCheck" value="1"
                        {{ old('status', $account->status) ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusCheck">Hoạt động</label>
                    @error('status')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Manage Class --}}
                <div class="col-md-6">
                    <label>Quản lý lớp</label>
                    <select name="classname" id="manageClass" class="form-control">
                        <option value="">-- Chọn lớp --</option>
                        @foreach ($classGrades as $code => $label)
                            <option value="{{ $code }}"
                                {{ old('classname', $account->classname) == $code ? 'selected' : '' }}>
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
                    <textarea name="note" class="form-control" rows="3">{{ old('note', $account->note) }}</textarea>
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Submit with Loading --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span id="btnText"><i class="fa-solid fa-floppy-disk"></i> Lưu</span>
                    <span id="btnLoading" class="d-none">
                        <i class="fas fa-spinner fa-spin"></i> Đang xử lý...
                    </span>
                </button>
            </div>
        </form>
    </div>

    <script>
        // Loading button
        const form = document.getElementById('accountForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
        });

        // Enable/disable Manage Class
        const roleSelect = document.getElementById('roleSelect');
        const manageClass = document.getElementById('manageClass');

        function toggleManageClass() {
            if (['teacher', 'nanny'].includes(roleSelect.value)) {
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
