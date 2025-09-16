@extends('admin.layout.app')
@section('title', 'Thêm activity')
@section('content')
    <div class="container">
        <h2>{{ isset($activity) ? 'Chỉnh sửa hoạt động' : 'Thêm hoạt động mới' }}</h2>

        {{-- Lỗi chung --}}
        @if ($errors->has('general'))
            <div class="alert alert-danger">
                {{ $errors->first('general') }}
            </div>
        @endif

        {{-- Lỗi validation --}}
        @if ($errors->any() && !$errors->has('general'))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
            action="{{ isset($activity) ? route('admin.activities.update', $activity->id) : route('admin.activities.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($activity))
                @method('PUT')
            @endif

            {{-- Title --}}
            <div class="mb-3">
                <label for="title">Tiêu đề</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $activity->title ?? '') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Main image --}}
            <div class="mb-3">
                <label for="image">Ảnh đại diện</label>
                <input type="file" id="image" name="image"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if (isset($activity) && $activity->image)
                    <div class="mt-2">
                        <img src="{{ $activity->image }}" alt="Ảnh hiện tại" class="img-thumbnail" width="200">
                    </div>
                @endif
            </div>
            {{-- Description --}}
            <div class="mb-3">
                <label for="shortdes">Mô tả chi tiết</label>
                <textarea id="shortdes" name="shortdes" class="form-control @error('shortdes') is-invalid @enderror" rows="6">{{ old('shortdes', $activity->shortdes ?? '') }}</textarea>
                @error('shortdes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Description --}}
            <div class="mb-3">
                <label for="description">Mô tả chi tiết</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                    rows="6">{{ old('description', $activity->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Type --}}
            <div class="mb-3">
                <label for="type">Loại hoạt động</label>
                <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                    <option value="">-- Chọn loại --</option>
                    <option value="1" {{ old('type', $activity->type ?? '') == 1 ? 'selected' : '' }}>Hoạt động học
                        tập</option>
                    <option value="2" {{ old('type', $activity->type ?? '') == 2 ? 'selected' : '' }}>Hoạt động vui
                        chơi</option>
                    <option value="3" {{ old('type', $activity->type ?? '') == 3 ? 'selected' : '' }}>Tin Tức</option>
                    <option value="4" {{ old('type', $activity->type ?? '') == 4 ? 'selected' : '' }}>Tư Vấn</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label for="status">Trạng thái</label>
                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="1" {{ old('status', $activity->status ?? '') == 1 ? 'selected' : '' }}>Hiển thị
                    </option>
                    <option value="0" {{ old('status', $activity->status ?? '') == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-primary">
                {{ isset($activity) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Summernote --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#description').summernote({
                placeholder: 'Nhập nội dung chi tiết...',
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
