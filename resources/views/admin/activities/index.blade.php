@extends('admin.layout.app')

@section('title', 'Danh sách activities')


@section('content')
    <div class="container">
        <h2>Danh sách Hoạt động</h2>

        <a href="{{ route('admin.activities.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ $activity->title }}</td>
                        <td>
                            @if ($activity->image)
                                <img src="{{ asset($activity->image) }}" width="100">
                            @endif
                        </td>
                        <td>
                            @switch($activity->type)
                                @case(1)
                                    Học tập
                                @break

                                @case(2)
                                    Vui chơi
                                @break

                                @case(3)
                                    Tin tức
                                @break

                                @case(4)
                                    Tư Vấn
                                @break

                                @default
                                    Không xác định
                            @endswitch
                        </td>
                        <td>{{ $activity->status ? 'Hiển thị' : 'Ẩn' }}</td>
                        <td>
                            <a href="{{ route('admin.activities.edit', $activity->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $activities->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
