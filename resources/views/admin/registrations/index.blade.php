{{-- resources/views/admin/registrations/index.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Quản lý đăng ký')

@section('content')
    <div class="container py-4">

        <h3 class="mb-3 text-primary fw-bold">
            <i class="fas fa-user-edit me-2"></i> Quản lý đăng ký
        </h3>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Bộ lọc (ẩn mặc định trên mobile) --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong><i class="fas fa-filter me-2 text-primary"></i>Bộ lọc</strong>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                    <i class="fas fa-sliders-h me-1"></i> Hiện / Ẩn
                </button>
            </div>
            <div id="filterPanel" class="collapse">
                <div class="card-body">
                    <form method="GET" class="row g-2">
                        <div class="col-12 col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-6 col-md-2">
                            <select name="status" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Đã liên
                                    hệ
                                </option>
                                <option value="not_contacted" {{ request('status') == 'not_contacted' ? 'selected' : '' }}>
                                    Chưa liên hệ</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <select name="result" class="form-select">
                                <option value="">Tất cả kết quả</option>
                                <option value="success" {{ request('result') == 'success' ? 'selected' : '' }}>Thành công
                                </option>
                                <option value="fail" {{ request('result') == 'fail' ? 'selected' : '' }}>Thất bại</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                        </div>
                        <div class="col-6 col-md-2">
                            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                        </div>
                        <div class="col-6 col-md-1 d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-6 col-md-1 d-grid">
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bảng dữ liệu --}}
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Phụ huynh</th>
                            <th>Điện thoại</th>
                            <th>Bé</th>
                            <th>Độ tuổi</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng ký</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                            <tr>
                                <td class="text-center">{{ $reg->id }}</td>
                                <td>{{ $reg->parent_name }}</td>
                                <td><a href="tel:{{ $reg->phone }}" class="text-decoration-none">{{ $reg->phone }}</a>
                                </td>
                                <td>{{ $reg->child_name }}</td>
                                <td class="text-center">{{ $reg->age_group }}</td>
                                <td class="text-center">
                                    @if ($reg->status)
                                        <span class="badge bg-success">Đã liên hệ</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Chưa liên hệ</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $reg->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route($authUser->role . '.registrations.show', $reg->id) }}"
                                        class="btn btn-sm btn-outline-primary mb-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if (in_array($authUser->role, ['manager']))
                                        <a href="{{ route('manager.registrations.toggleStatus', $reg->id) }}"
                                            class="btn btn-sm btn-outline-success mb-1"
                                            onclick="return confirm('Bạn có chắc muốn thay đổi trạng thái đăng ký này không?')">
                                            @if ($reg->status)
                                                <i class="fas fa-times-circle me-1 text-danger"></i>
                                            @else
                                                <i class="fas fa-check-circle me-1 text-success"></i>
                                            @endif

                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Phân trang --}}
            <div class="card-footer d-flex justify-content-center">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
@endsection
