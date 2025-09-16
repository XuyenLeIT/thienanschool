@extends('admin.layout.app')

@section('content')
<div class="container">
    <h3>Chỉnh sửa Education Content</h3>
    <form action="{{ route('admin.education.update', $educationContent) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $educationContent->title) }}">
        </div>

        {{-- Main Image --}}
        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="main_image" class="form-control">
            @if($educationContent->main_image)
                <img src="{{ asset($educationContent->main_image) }}" style="max-width:200px; margin-top:8px;">
            @endif
        </div>

        {{-- Caption --}}
        <div class="mb-3">
            <label>Caption</label>
            <input type="text" name="caption" class="form-control"
                value="{{ old('caption', $educationContent->caption) }}">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $educationContent->description) }}</textarea>
        </div>

        <hr>
        <h5>Item Images</h5>

        <div id="item-wrapper">
            @foreach ($educationContent->items as $i => $item)
                <div class="item-block border rounded p-3 mb-3">
                    <label>Image {{ $i + 1 }}</label>
                    <input type="file" name="item_images[]" class="form-control">
                    <input type="text" name="overlay_texts[]" class="form-control mt-1" placeholder="Overlay text"
                        value="{{ $item->overlay_text }}">
                    <input type="hidden" name="item_ids[]" value="{{ $item->id }}">
                    <img src="{{ asset($item->image) }}" style="max-width:150px; margin-top:5px;">
                </div>
            @endforeach
        </div>

        {{-- Template để clone --}}
        <div id="item-template" class="d-none">
            <div class="item-block border rounded p-3 mb-3">
                <label>New Image</label>
                <input type="file" name="item_images[]" class="form-control">
                <input type="text" name="overlay_texts[]" class="form-control mt-1" placeholder="Overlay text">
                <input type="hidden" name="item_ids[]" value="">
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-item">Xóa</button>
            </div>
        </div>

        <button type="button" id="add-item" class="btn btn-primary mb-3">+ Thêm Item</button>
        <br>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addBtn = document.getElementById("add-item");
        const wrapper = document.getElementById("item-wrapper");
        const template = document.getElementById("item-template").innerHTML;

        addBtn.addEventListener("click", function() {
            wrapper.insertAdjacentHTML("beforeend", template);
        });

        // Xóa item mới tạo
        wrapper.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-item")) {
                e.target.closest(".item-block").remove();
            }
        });
    });
</script>
@endsection
