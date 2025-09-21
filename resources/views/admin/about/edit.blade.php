@extends('admin.layout.app')
@section('title', 'Chỉnh sửa About')
@section('content')
    <div class="container">
        <h2>Chỉnh sửa Giới thiệu</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title', $about->title) }}"
                    class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $about->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" class="img-thumbnail mb-2" width="200">
            </div>

            <div class="mb-3">
                <label class="form-label">Đổi ảnh mới (nếu có)</label>
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Chỉ chấp nhận: jpg, jpeg, png | Tối đa 2MB</small>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
