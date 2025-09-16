@extends('admin.layout.app')

@section('title','Chỉnh sửa Promotion')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Promotion</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.promotions.update', $promotion->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $promotion->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $promotion->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            @if($promotion->image)
                <img src="{{ asset($promotion->image) }}" 
                     alt="{{ $promotion->title }}" 
                     class="img-thumbnail mb-2" width="200">
            @else
                <p>Chưa có ảnh</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Đổi ảnh mới (nếu có)</label>
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Chỉ chấp nhận: jpg, jpeg, png | Tối đa 2MB</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                @foreach(\App\Models\Promotion::getTypes() as $key => $val)
                    <option value="{{ $key }}" 
                        {{ old('type', $promotion->type) == $key ? 'selected' : '' }}>
                        {{ $val }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status"
                {{ old('status', $promotion->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Cập nhật
        </button>
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
