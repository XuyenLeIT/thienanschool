@extends('admin.layout.app')

@section('title', 'Chỉnh sửa Carousel')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Carousel</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.carausel.update', $carausel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tiêu đề -->
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $carausel->title) }}" required>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" required>{{ old('description', $carausel->description) }}</textarea>
        </div>

        <!-- Ảnh hiện tại -->
        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="{{ asset($carausel->image) }}" alt="{{ $carausel->title }}" class="img-thumbnail mb-2" width="200">
        </div>

        <!-- Đổi ảnh mới -->
        <div class="mb-3">
            <label class="form-label">Đổi ảnh mới (nếu có)</label>
            <input type="file" name="image" class="form-control">
            <small class="text-muted">Chỉ chấp nhận: jpg, jpeg, png | Tối đa 2MB</small>
        </div>

        <!-- Chọn page -->
        <div class="mb-3">
            <label class="form-label">Trang</label>
            <select name="page" class="form-select" required>
                @foreach(\App\Models\Carausel::getTypes() as $key => $value)
                    <option value="{{ $key }}" {{ old('page', $carausel->page) == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <!-- Trạng thái -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status"
                {{ old('status', $carausel->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <!-- Nút lưu -->
        <button type="submit" class="btn btn-primary carouselForm">
            <i class="fa fa-save"></i> Cập nhật
        </button>
        <a href="{{ route('admin.carausel.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
<script>
document.getElementById('carouselForm').addEventListener('submit', function () {
    const btn = document.getElementById('submitBtn');
    const spinner = document.getElementById('btnSpinner');
    const text = document.getElementById('btnText');

    spinner.classList.remove('d-none');
    text.textContent = "Đang lưu...";
    btn.disabled = true;
});
</script>