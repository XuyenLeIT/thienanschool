@extends('admin.layout.app')
@section('title', 'Danh sách thông báo phụ huynh')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Danh sách thông báo</h2>
                <a href="{{ route('admin.parent_notices.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <ul class="list-group shadow">
                    @forelse($notices as $notice)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $notice->title }}</h6>
                                    @if($notice->description)
                                        <p class="text-muted small mb-1">
                                            {{ Str::limit($notice->description, 100) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="ms-2">
                                    <a href="{{ route('admin.parent_notices.edit', $notice->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.parent_notices.destroy', $notice->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Xóa thông báo này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Chưa có thông báo nào.</li>
                    @endforelse
                </ul>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.feedbacks.index') }}" class="btn btn-primary mb-3">Danh Sách Feedback</a>
                <a href="{{ route('admin.love-messages.index') }}" class="btn btn-primary mb-3">Love message</a>
            </div>
        </div>
    </div>
@endsection
