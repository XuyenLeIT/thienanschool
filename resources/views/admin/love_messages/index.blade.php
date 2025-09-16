@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h2 class="section-title">Danh sách tình yêu thương của bé</h2>
    <a href="{{ route('admin.love-messages.create') }}" class="btn btn-primary mb-3">+ Thêm bé</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="50">#</th>
                    <th width="100">Ảnh</th>
                    <th>Tên bé</th>
                    <th>Lời nhắn</th>
                    <th width="180" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $index => $msg)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ $msg->avatar ? asset($msg->avatar) : 'https://picsum.photos/80' }}" 
                                 class="rounded-circle" width="60" height="60" alt="{{ $msg->name }}">
                        </td>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->message }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.love-messages.edit', $msg->id) }}" class="btn btn-sm btn-warning">
                                Sửa
                            </a>
                            <form action="{{ route('admin.love-messages.destroy', $msg->id) }}" 
                                  method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Chưa có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
