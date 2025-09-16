@extends('admin.layout.app')
@section('title', isset($notice) ? 'Chỉnh sửa thông báo' : 'Thêm thông báo')

@section('content')
<div class="container">
    <h2>{{ isset($notice) ? 'Chỉnh sửa thông báo' : 'Thêm thông báo mới' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($notice) ? route('admin.parent_notices.update', $notice->id) : route('admin.parent_notices.store') }}" method="POST">
        @csrf
        @if(isset($notice)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Tiêu đề thông báo</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $notice->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $notice->description ?? '') }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status" 
                   {{ old('status', $notice->status ?? 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-success">
            {{ isset($notice) ? 'Cập nhật' : 'Thêm mới' }}
        </button>
        <a href="{{ route('admin.parent_notices.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
