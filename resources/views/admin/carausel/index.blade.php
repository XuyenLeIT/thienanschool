@extends('admin.layout.app')

@section('title', 'Danh sách Carousel')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Danh sách Carousel</h2>
        <a href="{{ route('admin.carausel.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Trang</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carausels as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" width="100"
                                    class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Chưa có ảnh</span>
                            @endif
                        </td>
                        <td>{{ \App\Models\Carausel::getTypes()[$item->page] ?? 'Unknown' }}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-success">Hiện</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.carausel.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.carausel.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Chưa có carousel nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
