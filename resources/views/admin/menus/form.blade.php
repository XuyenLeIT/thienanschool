@extends('admin.layout.app')

@section('title', isset($menu) ? 'Chỉnh sửa thực đơn' : 'Thêm thực đơn')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($menu) ? 'Chỉnh sửa thực đơn' : 'Thêm thực đơn' }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($menu) ? route('manager.menus.update', $menu->id) : route('manager.menus.store') }}" method="POST">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label fw-bold">Ngày</label>
            <input type="text" name="day" class="form-control" placeholder="Ví dụ: Thứ Hai, 14/10" 
                   value="{{ old('day', $menu->day ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bữa sáng</label>
            <textarea name="breakfast" class="form-control auto-resize" rows="3" placeholder="Nhập món ăn sáng..." required>{{ old('breakfast', $menu->breakfast ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bữa trưa</label>
            <textarea name="lunch" class="form-control auto-resize" rows="3" placeholder="Nhập món ăn trưa..." required>{{ old('lunch', $menu->lunch ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Bữa xế</label>
            <textarea name="snack" class="form-control auto-resize" rows="3" placeholder="Nhập món ăn xế..." required>{{ old('snack', $menu->snack ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-save me-1"></i> {{ isset($menu) ? 'Cập nhật' : 'Thêm mới' }}
        </button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-1"></i> Quay lại
        </a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('.auto-resize');
    textareas.forEach(area => {
        area.style.height = area.scrollHeight + 'px';
        area.addEventListener('input', () => {
            area.style.height = 'auto';
            area.style.height = area.scrollHeight + 'px';
        });
    });
});
</script>
@endsection
