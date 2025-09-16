@extends('admin.layout.app')

@section('title', 'Danh sách Feedback')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Feedback</h2>
    <a href="{{ route('admin.feedbacks.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Phụ huynh</th>
                <th>Avatar</th>
                <th>Phản hồi</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->parent }}</td>
                <td>
                    @if($item->avatar)
                        <img src="{{ $item->avatar }}" alt="{{ $item->name }}" width="50" height="50" class="rounded-circle">
                    @else
                        <span class="text-muted">No avatar</span>
                    @endif
                </td>
                <td>{{ $item->feedback }}</td>
                <td>
                    @if($item->status)
                        <span class="badge bg-success">Hiện</span>
                    @else
                        <span class="badge bg-secondary">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.feedbacks.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.feedbacks.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa không?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Chưa có dữ liệu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
