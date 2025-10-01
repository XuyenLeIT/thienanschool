@extends('admin.layout.app')
@section('title', 'Quản lý học sinh')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Danh sách học sinh</h2>
        <a href="{{ route($authUser->role . '.students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm học sinh
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
  <form method="GET" action="{{ route($authUser->role . '.students.index') }}" class="row mb-3 g-2">
    <div class="col-md-3">
        <input type="text" name="search" class="form-control"
               placeholder="Tìm theo tên học sinh / phụ huynh"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <select name="classname" class="form-select">
            <option value="">-- Tất cả lớp --</option>
            @foreach ($classGrades as $code => $label)
                <option value="{{ $code }}" {{ request('classname') == $code ? 'selected' : '' }}>
                    {{ $label.'-'.$code }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">-- Tất cả trạng thái --</option>
            @foreach ($statusList as $key => $label)
                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="s_delete" class="form-select">
            <option value="0" {{ request('s_delete', '0') == '0' ? 'selected' : '' }}>Đang hoạt động</option>
            <option value="1" {{ request('s_delete') == '1' ? 'selected' : '' }}>Đã xóa</option>
        </select>
    </div>

    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
        <a href="{{ route($authUser->role . '.students.index') }}" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Số điện thoại</th>
                <th>Tuổi</th>
                <th>Tình trạng</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->fullname }}</td>
                    <td>{{ $student->classname }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->age }}</td>
                    <td>
                        <span class="badge bg-{{ $student->getStatusBadge() }}">
                            {{ $student->getStatusLabel() }}
                        </span>
                    </td>
                    <td>
                        @if ($student->image && file_exists(public_path($student->image)))
                            <img src="{{ asset($student->image) }}" width="60" class="rounded">
                        @else
                            <span class="text-muted">Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <!-- Nút mở modal -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#studentModal{{ $student->id }}">
                            <i class="fas fa-eye"></i>
                        </button>

                        <a href="{{ route($authUser->role . '.students.edit', $student->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        @if ($student->s_delete == 0)
                            {{-- Nút Xóa (soft delete) --}}
                            <form action="{{ route($authUser->role . '.students.destroy', $student->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa học sinh này?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @else
                            {{-- Nút Khôi phục --}}
                            <form action="{{ route($authUser->role . '.students.restore', $student->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning btn-sm" onclick="return confirm('Khôi phục học sinh này?')">
                                    <i class="fas fa-undo"></i> Khôi phục
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>

                <!-- Modal chi tiết -->
                <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1"
                    aria-labelledby="studentModalLabel{{ $student->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="studentModalLabel{{ $student->id }}">
                                    Thông tin học sinh: {{ $student->fullname }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        @if ($student->image && file_exists(public_path($student->image)))
                                            <img src="{{ asset($student->image) }}" class="img-fluid rounded mb-3"
                                                width="200">
                                        @else
                                            <img src="https://via.placeholder.com/200" class="img-fluid rounded mb-3">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <p><strong>Họ tên:</strong> {{ $student->fullname }}</p>
                                        <p><strong>Phụ huynh:</strong> {{ $student->parent }}</p>
                                        <p><strong>Số điện thoại:</strong> {{ $student->phone }}</p>
                                        <p><strong>Lớp:</strong> {{ $student->classname }} - {{ $student->grade }}</p>
                                        <p><strong>Ngày bắt đầu học:</strong> {{ $student->startdate }}</p>
                                        <p><strong>Ngày sinh:</strong> {{ $student->birthday ?? '-' }}</p>
                                        <p><strong>Tuổi:</strong> {{ $student->age }}</p>
                                        <p><strong>Địa chỉ:</strong> {{ $student->address }}</p>
                                        <p><strong>Giới tính:</strong> {{ $student->gender ? 'Nam' : 'Nữ' }}</p>
                                        <p><strong>Tình trạng:</strong> {{ $student->status ? 'Đang học' : 'Đã nghỉ' }}</p>
                                        <p><strong>Ghi chú:</strong> {{ $student->note ?? '---' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có học sinh nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
