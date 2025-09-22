@extends('admin.layout.app')
@section('title', isset($student) ? 'Chỉnh sửa học sinh' : 'Thêm học sinh')

@section('content')
    <div class="container">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary px-4 mb-2">Quay lại</a>
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thêm học sinh</h4>
            </div>
           
            <div class="card-body">
                <form
                    action="{{ isset($student) ? route('admin.students.update', $student->id) : route('admin.students.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($student))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Họ tên</label>
                            <input type="text" name="fullname" class="form-control"
                                value="{{ old('fullname', $student->fullname ?? '') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên phụ huynh</label>
                            <input type="text" name="parent" class="form-control"
                                value="{{ old('parent', $student->parent ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $student->phone ?? '') }}">
                        </div>

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

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên lớp</label>
                            <input type="text" name="grade" id="grade" class="form-control"
                                value="{{ old('grade', $student->grade ?? '') }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày bắt đầu học</label>
                            <input type="date" name="startdate" class="form-control"
                                value="{{ old('startdate', $student->startdate ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày sinh</label>
                            <input type="date" name="birthday" class="form-control"
                                value="{{ old('birthday', $student->birthday ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tuổi</label>
                            <input type="number" name="age" class="form-control"
                                value="{{ old('age', $student->age ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $student->address ?? '') }}">
                        </div>

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

                        <div class="col-md-6">
                            <label class="form-label fw-bold d-block">Tình trạng học</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_active"
                                    value="1" {{ old('status', $student->status ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_active">Đang học</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                    value="0" {{ old('status', $student->status ?? 1) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_inactive">Đã nghỉ</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3">{{ old('note', $student->note ?? '') }}</textarea>
                        </div>

                        <div class="col-12">
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
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary px-4">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('classname').addEventListener('change', function() {
            let grade = this.options[this.selectedIndex].getAttribute('data-grade') || '';
            document.getElementById('grade').value = grade;
        });

        // Nếu đang edit thì hiển thị grade sẵn theo classname
        window.addEventListener('DOMContentLoaded', function() {
            let select = document.getElementById('classname');
            let grade = select.options[select.selectedIndex]?.getAttribute('data-grade') || '';
            document.getElementById('grade').value = grade;
        });
    </script>
@endsection
