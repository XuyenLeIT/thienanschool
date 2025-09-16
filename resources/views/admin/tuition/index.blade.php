@extends('admin.layout.app')

@section('content')
<h2>Danh sách Học phí & Chính sách</h2>
<a href="{{ route('admin.tuition.create') }}" class="btn btn-success mb-3">Thêm mới</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered text-center">
    <thead class="table-primary">
        <tr>
            <th>Khối lớp</th>
            <th>Học phí (VNĐ/tháng)</th>
            <th>Ghi chú</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tuitions as $t)
        <tr>
            <td>{{ $t->grade }}</td>
            <td>{{ number_format($t->fee) }}</td>
            <td>{{ $t->note }}</td>
            <td>
                <a href="{{ route('admin.tuition.edit', $t->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.tuition.destroy', $t->id) }}" method="POST" class="d-inline-block" 
                      onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Chưa có dữ liệu.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
