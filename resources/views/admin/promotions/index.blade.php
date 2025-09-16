@extends('admin.layout.app')
@section('title','Danh sách Promotions')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Danh sách Promotions</h2>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Type</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        @if($item->image)
                        <img src="{{ asset($item->image) }}" width="80" class="rounded shadow-sm">
                        @endif
                    </td>
                    <td>{{ \App\Models\Promotion::getTypes()[$item->type] ?? 'Unknown' }}</td>
                    <td>
                        @if($item->status)
                            <span class="badge bg-success">Hiện</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.promotions.edit',$item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.promotions.destroy',$item->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Xóa promotion?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $promotions->links() }}
</div>
@endsection
