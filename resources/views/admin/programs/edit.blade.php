@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h3>Edit Program</h3>

        <form action="{{ route('admin.programs.update', $program) }}" method="POST">
            @csrf 
            @method('PUT')

            <div class="mb-3">
                <label>Icon (FontAwesome class)</label>
                <input type="text" 
                       name="icon" 
                       class="form-control" 
                       value="{{ old('icon', $program->icon) }}">
                @error('icon') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text" 
                       name="title" 
                       class="form-control" 
                       value="{{ old('title', $program->title) }}">
                @error('title') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $program->description) }}</textarea>
                @error('description') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-select">
                    <option value="">-- Chọn loại --</option>
                    @foreach(\App\Models\Program::getTypes() as $key => $label)
                        <option value="{{ $key }}" 
                            {{ old('type', $program->type) == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('type') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
