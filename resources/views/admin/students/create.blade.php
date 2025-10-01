@extends('admin.layout.app')
@section('title', isset($student) ? 'Chỉnh sửa học sinh' : 'Thêm học sinh')

@section('content')
    <div class="container">
        <a href="{{ route($authUser->role . '.students.index') }}" class="btn btn-secondary px-4 mb-3">Quay lại</a>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ isset($student) ? 'Chỉnh sửa học sinh' : 'Thêm học sinh' }}</h4>
            </div>

            <div class="card-body">
                <form
                    action="{{ isset($student)
                        ? route($authUser->role . '.students.update', $student->id)
                        : route($authUser->role . '.students.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($student))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        {{-- Họ tên --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Họ tên</label>
                            <input type="text" name="fullname" class="form-control"
                                value="{{ old('fullname', $student->fullname ?? '') }}" required>
                        </div>

                        {{-- Phụ huynh --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên phụ huynh</label>
                            <input type="text" name="parent" class="form-control"
                                value="{{ old('parent', $student->parent ?? '') }}">
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $student->phone ?? '') }}">
                        </div>

                        {{-- Mã lớp --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Mã lớp</label>
                            <select name="classname" id="classname" class="form-select">
                                <option value="">-- Chọn lớp --</option>
                                @foreach ($classGrades as $code => $grade)
                                    <option value="{{ $code }}" data-grade="{{ $grade }}"
                                        {{ old('classname', $student->classname ?? '') == $code ? 'selected' : '' }}>
                                        {{ $code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tên lớp --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên lớp</label>
                            <input type="text" name="grade" id="grade" class="form-control"
                                value="{{ old('grade', $student->grade ?? '') }}" readonly>
                        </div>

                        {{-- Ngày bắt đầu học --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày bắt đầu học</label>
                            <input type="date" name="startdate" class="form-control"
                                value="{{ old('startdate', isset($student->startdate) ? $student->startdate->format('Y-m-d') : '') }}">
                        </div>

                        {{-- Ngày sinh --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày sinh</label>
                            <input type="date" name="bod" class="form-control"
                                value="{{ old('bod', isset($student->bod) ? $student->bod->format('Y-m-d') : '') }}">
                        </div>

                        {{-- Tuổi --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tuổi</label>
                            <input type="number" name="age" class="form-control"
                                value="{{ old('age', $student->age ?? '') }}">
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $student->address ?? '') }}">
                        </div>

                        {{-- Giới tính --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold d-block">Giới tính</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                    value="1" {{ old('gender', $student->gender ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_male">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                    value="0" {{ old('gender', $student->gender ?? 1) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="gender_female">Nữ</label>
                            </div>
                        </div>

                        {{-- Trạng thái + Ghi chú cùng dòng --}}
                        <div class="col-md-12">
                            <div class="row">
                                {{-- Trạng thái --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tình trạng học</label>
                                    <select name="status" class="form-select">
                                        @foreach ($statusList as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('status', $student->status ?? 0) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Ghi chú --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ghi chú</label>
                                    <textarea name="note" class="form-control" rows="3">{{ old('note', $student->note ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>


                        {{-- Ảnh đại diện --}}
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Ảnh đại diện</label>
                            <input type="file" name="image" class="form-control">
                            @if (isset($student) && $student->image)
                                <div class="mt-2">
                                    <img src="{{ asset($student->image) }}" width="100" class="rounded border">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            {{ isset($student) ? 'Cập nhật' : 'Lưu' }}
                        </button>
                        <a href="{{ route($authUser->role . '.students.index') }}" class="btn btn-secondary px-4">Quay
                            lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Gán grade theo mã lớp
        document.getElementById('classname').addEventListener('change', function() {
            let grade = this.options[this.selectedIndex].getAttribute('data-grade') || '';
            document.getElementById('grade').value = grade;
        });

        // Hiển thị grade sẵn khi edit
        window.addEventListener('DOMContentLoaded', function() {
            let select = document.getElementById('classname');
            let grade = select.options[select.selectedIndex]?.getAttribute('data-grade') || '';
            document.getElementById('grade').value = grade;
        });
    </script>
@endsection
