@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h3>Gallery List</h3>
        @foreach ($galleries as $gallery)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $gallery->title }}</h4>
                    <p>{{ $gallery->description }}</p>
                    <div class="d-flex flex-wrap">
                        @foreach ($gallery->images as $img)
                            <img src="{{ asset( $img->image_path) }}" class="img-thumbnail m-1" style="width:150px;">
                        @endforeach
                    </div>
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
