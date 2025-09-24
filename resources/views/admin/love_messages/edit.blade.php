@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h3>Cập nhật bé yêu thương</h3>
    <form action="{{ route('admin.love-messages.update', $loveMessage->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tên bé</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $loveMessage->name) }}" required>
        </div>
        <div class="mb-3">
            <label>Ảnh đại diện</label>
            @if($loveMessage->avatar)
                <div class="mb-2">
                    <img src="{{ asset($loveMessage->avatar) }}" alt="Avatar" width="100" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="avatar" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lời nhắn</label>
            <textarea name="message" rows="3" class="form-control" required>{{ old('message', $loveMessage->message) }}</textarea>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
