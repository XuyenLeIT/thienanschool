@extends('admin.layout.app')

@section('content')
<div class="container">
    <h3>Education Content</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <h5>Title:</h5>
        <p>{{ $content->title }}</p>
    </div>

    <div class="mb-3">
        <h5>Main Image:</h5>
        <img src="{{ asset($content->main_image) }}" alt="Main Image" class="img-fluid mb-2" style="max-width:400px;">
    </div>

    <div class="mb-3">
        <h5>Caption:</h5>
        <p>{{ $content->caption }}</p>
    </div>

    <div class="mb-3">
        <h5>Description:</h5>
        <p>{{ $content->description }}</p>
    </div>

    <div class="mb-3">
        <h5>Items:</h5>
        <div class="row">
            @foreach ($content->items as $item)
                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm">
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image">
                        <div class="card-body p-2">
                            <p class="mb-0">{{ $item->overlay_text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.education.edit', $content) }}" class="btn btn-primary">Chỉnh sửa</a>
</div>
@endsection
