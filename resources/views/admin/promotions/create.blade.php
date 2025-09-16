@extends('admin.layout.app')
@section('title','Thêm Promotion')

@section('content')
<div class="container">
    <h2>Thêm Promotion</h2>
    <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                @foreach(\App\Models\Promotion::getTypes() as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" checked>
            <label class="form-check-label">Hiển thị</label>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
