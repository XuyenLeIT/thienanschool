@extends('admin.layout.app')

@section('title', 'Thêm mới Nhân viên')

@section('content')
    <div class="container">
        {{-- Back button --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Thêm mới Nhân viên</h3>
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.accounts.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- Fullname --}}
                <div class="col-md-6">
                    <label>Fullname</label>
                    <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="col-md-6">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="col-md-6">
                    <label>Role</label>
                    <select name="role" id="roleSelect" class="form-control">
                        @foreach ($roles as $role)
                            @php
                                $disabled = '';
                                if ($authUser->role === 'manager' && in_array($role, ['admin', 'manager'])) {
                                    $disabled = 'disabled';
                                }
                            @endphp
                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}
                                {{ $disabled }}>
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
                    <label>Start Date</label>
                    <input type="date" name="startdate" class="form-control" value="{{ old('startdate') }}">
                    @error('startdate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Admin Approve --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="admin_approve" value="0">
                    <input type="checkbox" name="admin_approve" class="form-check-input me-2" id="adminApproveCheck"
                        value="1" {{ $authUser->role !== 'admin' ? 'disabled' : '' }}>
                    <label class="form-check-label" for="adminApproveCheck">Admin Approve</label>
                    @error('admin_approve')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6 d-flex align-items-center mt-2">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" name="status" class="form-check-input me-2" id="statusCheck" value="1"
                        {{ old('status') ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusCheck">Active</label>
                    @error('status')
                        <small class="text-danger ms-2">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Manage Class --}}
                <div class="col-md-6">
                    <label>Manage Class</label>
                    <select name="manage_class" id="manageClass" class="form-control" disabled>
                        <option value="" {{ old('manage_class') == '' ? 'selected' : '' }}>-- Chọn lớp --</option>
                        <option value="Mầm" {{ old('manage_class') == 'Mầm' ? 'selected' : '' }}>Mầm</option>
                        <option value="Chồi" {{ old('manage_class') == 'Chồi' ? 'selected' : '' }}>Chồi</option>
                        <option value="Lá" {{ old('manage_class') == 'Lá' ? 'selected' : '' }}>Lá</option>
                    </select>
                    @error('manage_class')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Note --}}
                <div class="col-12">
                    <label>Note</label>
                    <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                    @error('note')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Create
                </button>
            </div>
        </form>
    </div>

    {{-- JS enable/disable Manage Class --}}
    <script>
        const roleSelect = document.getElementById('roleSelect');
        const manageClass = document.getElementById('manageClass');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'teacher') {
                manageClass.disabled = false;
            } else {
                manageClass.disabled = true;
                manageClass.value = '';
            }
        });
    </script>
@endsection
