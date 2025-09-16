{{-- resources/views/admin/registrations/index.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Quản lý đăng ký')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Danh sách đăng ký</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

{{-- Form lọc và tìm kiếm --}}
<form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
    </div>
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Đã liên hệ</option>
            <option value="not_contacted" {{ request('status') == 'not_contacted' ? 'selected' : '' }}>Chưa liên hệ</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="result" class="form-select">
            <option value="">-- Tất cả kết quả --</option>
            <option value="success" {{ request('result') == 'success' ? 'selected' : '' }}>Thành công - Bé đồng ý nhập học</option>
            <option value="fail" {{ request('result') == 'fail' ? 'selected' : '' }}>Thất bại - Đang tham khảo</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-2">
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
    </div>
    <div class="col-md-1">
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>


    {{-- Table --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Họ tên phụ huynh</th>
                <th>Số điện thoại</th>
                <th>Họ tên bé</th>
                <th>Độ tuổi</th>
                <th>Trạng thái</th>
                <th>Thời gian đăng ký</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $reg)
            <tr>
                <td>{{ $reg->id }}</td>
                <td>{{ $reg->parent_name }}</td>
                <td>{{ $reg->phone }}</td>
                <td>{{ $reg->child_name }}</td>
                <td>{{ $reg->age_group }}</td>
                <td>
                    @if($reg->status)
                        <span class="badge bg-success">Đã liên hệ</span>
                    @else
                        <span class="badge bg-warning text-dark">Chưa liên hệ</span>
                    @endif
                </td>
                <td>{{ $reg->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.registrations.show', $reg->id) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                    <form action="{{ route('admin.registrations.toggleStatus', $reg->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">
                            {{ $reg->status ? 'Đặt chưa liên hệ' : 'Đánh dấu đã liên hệ' }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Không có dữ liệu</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $registrations->links() }}
    </div>
</div>
@endsection
