@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h2>Edit Special Feature</h2>
    <form action="{{ route('admin.special_features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $feature->title) }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $feature->description) }}</textarea>
        </div>

        {{-- Images --}}
        <div class="mb-3">
            <label class="form-label">Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
            
            @if ($feature->images->count())
                <div class="mt-2">
                    @foreach ($feature->images as $img)
                        <div class="d-inline-block position-relative me-2 mb-2">
                            <img src="{{ asset($img->image) }}" style="height:80px; display:block;">
                            <label class="form-check-label position-absolute top-0 start-0 bg-light px-1">
                                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"> Xóa
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sub Descriptions --}}
        <div class="mb-3">
            <label class="form-label">Sub Descriptions</label>
            <div id="subdes-container">
                @foreach ($feature->subdes as $sub)
                    <div class="subdes-item mb-2">
                        <input type="text" name="subdes_title[]" value="{{ $sub->title }}" class="form-control mb-1" placeholder="Sub Title" required>
                        <input type="text" name="subdes_icon_class[]" value="{{ $sub->icon_class }}" class="form-control mb-1" placeholder="Icon Class (e.g., fa-solid fa-star)">
                        <textarea name="subdes_description[]" class="form-control mb-1" placeholder="Sub Description" required>{{ $sub->description }}</textarea>
                        <button type="button" class="btn btn-sm btn-danger remove-subdes">Remove</button>
                    </div>
                @endforeach
            </div>

            {{-- Template clone --}}
            <template id="subdes-template">
                <div class="subdes-item mb-2">
                    <input type="text" name="subdes_title[]" class="form-control mb-1" placeholder="Sub Title" required>
                    <input type="text" name="subdes_icon_class[]" class="form-control mb-1" placeholder="Icon Class (e.g., fa-solid fa-star)">
                    <textarea name="subdes_description[]" class="form-control mb-1" placeholder="Sub Description" required></textarea>
                    <button type="button" class="btn btn-sm btn-danger remove-subdes">Remove</button>
                </div>
            </template>

            <button type="button" id="add-subdes" class="btn btn-sm btn-primary mt-2">Add Sub Description</button>
        </div>

        {{-- Buttons --}}
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.special_features.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

{{-- JS --}}
<script>
    // Thêm Sub Description mới
    document.getElementById('add-subdes').addEventListener('click', function() {
        let container = document.getElementById('subdes-container');
        let template = document.getElementById('subdes-template').content.cloneNode(true);
        container.appendChild(template);
    });

    // Xóa Sub Description
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-subdes')) {
            e.target.closest('.subdes-item').remove();
        }
    });
</script>
@endsection
