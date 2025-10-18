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
            <input type="text" name="search" class="form-control" placeholder="Tìm theo tên học sinh / phụ huynh"
                value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <select name="classname" class="form-select">
                <option value="">-- Tất cả lớp --</option>
                @foreach ($classGrades as $code => $label)
                    <option value="{{ $code }}" {{ request('classname') == $code ? 'selected' : '' }}>
                        {{ $label . '-' . $code }}
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
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">

                            {{-- Header --}}
                            <div class="modal-header"
                                style="background-color: #ffd89b; color: #5c3c00; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                <h5 class="modal-title fw-bold d-flex align-items-center gap-2"
                                    id="studentModalLabel{{ $student->id }}">
                                    🧒 Thông tin học sinh: <span class="text-primary">{{ $student->fullname }}</span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>

                            {{-- Body --}}
                            <div class="modal-body" style="background-color: #fffaf5;">
                                <div class="row">
                                    <div class="col-md-4 text-center mb-3">
                                        <div class="position-relative d-inline-block">
                                            @if ($student->image && file_exists(public_path($student->image)))
                                                <img src="{{ asset($student->image) }}"
                                                    class="img-fluid rounded-circle shadow-sm border border-3 border-warning"
                                                    width="180" height="180" alt="{{ $student->fullname }}">
                                            @else
                                                <img src="https://cdn-icons-png.flaticon.com/512/921/921071.png"
                                                    class="img-fluid rounded-circle shadow-sm border border-3 border-warning"
                                                    width="180" height="180" alt="student avatar">
                                            @endif
                                            {{-- Icon hoạt hình nhỏ góc ảnh --}}
                                            <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
                                                alt="cute icon" width="50"
                                                style="position:absolute; bottom:-10px; right:-10px; opacity:0.9;">
                                        </div>
                                        <p class="mt-3 fw-semibold text-secondary">
                                            {{ $student->gender ? '👦 Bé trai' : '👧 Bé gái' }}
                                        </p>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="p-3 rounded" style="background-color:#fff3cd;">
                                            <p><strong>👨‍👩‍👧 Phụ huynh:</strong> {{ $student->parent }}</p>
                                            <p><strong>📞 Số điện thoại:</strong> {{ $student->phone }}</p>
                                            <p><strong>🏫 Lớp:</strong> {{ $student->classname }} - {{ $student->grade }}
                                            </p>
                                            <p><strong>🎂 Ngày sinh:</strong> {{ $student->birthday ?? '-' }}</p>
                                            <p><strong>🧮 Tuổi:</strong> {{ $student->age }}</p>
                                            <p><strong>📅 Bắt đầu học:</strong> {{ $student->startdate }}</p>
                                            <p><strong>📍 Địa chỉ:</strong> {{ $student->address }}</p>
                                            <p><strong>📚 Tình trạng:</strong>
                                                <span
                                                    class="badge {{ $student->status ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $student->status ? 'Đang học' : 'Đã nghỉ' }}
                                                </span>
                                            </p>
                                            <p><strong>📝 Ghi chú:</strong> {{ $student->note ?? '---' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="modal-footer"
                                style="background-color:#fffaf0; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                    ✨ Đóng
                                </button>
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
