@extends('admin.layout.app')
@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>{{ $feature->title }}</h3>
    <p>{{ $feature->description }}</p>

    @if($feature->images->count())
        <div class="mb-3">
            @foreach($feature->images as $img)
                <img src="{{ asset($img->image) }}" style="height:80px; margin-right:5px;">
            @endforeach
        </div>
    @endif

    @if($feature->subdes->count())
        <div class="mb-3">
            @foreach($feature->subdes as $sub)
                <p><strong>{{ $sub->title }}:</strong> {{ $sub->description }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.special_features.edit', $feature->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
