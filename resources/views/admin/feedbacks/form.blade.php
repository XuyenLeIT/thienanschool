@extends('admin.layout.app')

@section('title', isset($feedback) ? 'Chỉnh sửa Feedback' : 'Thêm Feedback')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($feedback) ? 'Chỉnh sửa Feedback' : 'Thêm Feedback' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($feedback) ? route('admin.feedbacks.update', $feedback->id) : route('admin.feedbacks.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($feedback))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Tên người phản hồi</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $feedback->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cha/mẹ của bé</label>
            <input type="text" name="parent" class="form-control" 
                   value="{{ old('parent', $feedback->parent ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phản hồi</label>
            <textarea name="feedback" class="form-control" rows="4" required>{{ old('feedback', $feedback->feedback ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh đại diện</label><br>
            @if(isset($feedback) && $feedback->avatar)
                <img src="{{ asset($feedback->avatar) }}" alt="Avatar" class="img-thumbnail mb-2" width="100">
            @endif
            <input type="file" name="avatar" class="form-control">
            <small class="text-muted">Chỉ chấp nhận: jpg, jpeg, png | Tối đa 2MB</small>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="status" id="status"
                   {{ old('status', $feedback->status ?? 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> {{ isset($feedback) ? 'Cập nhật' : 'Thêm mới' }}
        </button>
        <a href="{{ route('admin.feedbacks.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
