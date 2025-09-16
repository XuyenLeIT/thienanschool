@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h3>Thêm bé yêu thương</h3>
    <form action="{{ route('admin.love-messages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tên bé</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ảnh đại diện</label>
            <input type="file" name="avatar" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lời nhắn</label>
            <textarea name="message" rows="3" class="form-control" required></textarea>
        </div>
        <button class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
