@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h3>Programs</h3>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary mb-3">+ Add Program</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr>
                        <td>
                            <i class="{{ $program->icon }}"></i> 
                            <small class="text-muted">{{ $program->icon }}</small>
                        </td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->description }}</td>
                        <td>
                            {{ \App\Models\Program::getTypes()[$program->type] ?? 'N/A' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No programs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
