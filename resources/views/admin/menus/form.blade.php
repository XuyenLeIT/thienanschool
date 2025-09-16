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

    <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}"
          method="POST">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Ngày</label>
            <input type="text" name="day" class="form-control" value="{{ old('day', $menu->day ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sáng</label>
            <input type="text" name="breakfast" class="form-control" value="{{ old('breakfast', $menu->breakfast ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Trưa</label>
            <input type="text" name="lunch" class="form-control" value="{{ old('lunch', $menu->lunch ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Xế</label>
            <input type="text" name="snack" class="form-control" value="{{ old('snack', $menu->snack ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($menu) ? 'Cập nhật' : 'Thêm mới' }}</button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
