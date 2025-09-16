@extends('admin.layout.app')

@section('content')
    <h2>Form Tuition</h2>
    @php $isEdit = isset($tuition); @endphp

    <form action="{{ $isEdit ? route('admin.tuition.update', $tuition->id) : route('admin.tuition.store') }}" method="POST">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="grade" class="form-label">Khối lớp</label>
            <input type="text" name="grade" id="grade" class="form-control"
                value="{{ old('grade', $tuition->grade ?? '') }}" placeholder="Nhà trẻ, Mẫu giáo bé,...">
            @error('grade')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fee" class="form-label">Học phí (VNĐ/tháng)</label>
            <input type="number" name="fee" id="fee" class="form-control"
                value="{{ old('fee', $tuition->fee ?? '') }}" placeholder="3000000">
            @error('fee')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú</label>
            <input type="text" name="note" id="note" class="form-control"
                value="{{ old('note', $tuition->note ?? '') }}" placeholder="Đã bao gồm ăn trưa,...">
            @error('note')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Cập nhật' : 'Thêm mới' }}</button>
        <a href="{{ route('admin.tuition.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
