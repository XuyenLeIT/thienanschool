@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h3>Edit Gallery</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Hiển thị message thành công --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Add More Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <div class="mb-3">
                <label>Current Images</label>
                <div class="d-flex flex-wrap">
                    @foreach ($gallery->images as $img)
                        <div class="position-relative m-2" style="width:150px;">
                            <img src="{{ asset($img->image_path) }}" class="img-thumbnail"
                                style="width:150px; height:100px; object-fit:cover;">

                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="delete_images[]"
                                    value="{{ $img->id }}" id="{{ $img->id }}">
                                <label class="form-check-label" for="{{ $img->id }}">Delete</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <button class="btn btn-success">Update</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
