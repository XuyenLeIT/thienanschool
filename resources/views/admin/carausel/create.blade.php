@extends('admin.layout.app')
@section('title', 'Add a Carousel')

@section('content')
<div class="container">
    <h2>Thêm Carousel</h2>

    <form id="carouselForm" action="{{ route('admin.carausel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control" required>
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trang</label>
            <select name="page" class="form-select" required>
                @foreach(\App\Models\Carausel::getTypes() as $key => $value)
                    <option value="{{ $key }}" {{ old('page') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            @error('page') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" checked>
            <label class="form-check-label">Hiển thị</label>
        </div>

        <button id="submitBtn" type="submit" class="btn btn-success">
            <span id="btnText">Lưu</span>
            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
        </button>
    </form>
</div>
@endsection

@section('scripts')
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
@endsection
