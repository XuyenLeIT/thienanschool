@extends('admin.layout.app')

@section('content')
<div class="container">
    <h3>Lịch học mẫu một ngày</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped text-center">
        <thead class="table-primary">
            <tr>
                <th>Thời gian</th>
                <th>Hoạt động</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody id="sortable">
            @forelse($schedules as $schedule)
                <tr data-id="{{ $schedule->id }}">
                    <td>{{ $schedule->time }}</td>
                    <td>{{ $schedule->activity }}</td>
                    <td>
                        <a href="{{ route('admin.daily_schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.daily_schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Chưa có dữ liệu.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('sortable');
    Sortable.create(el, {
        animation: 150,
        onEnd: function (evt) {
            const order = [];
            el.querySelectorAll('tr').forEach((tr, index) => {
                order.push({ id: tr.dataset.id, order: index });
            });

            fetch('{{ route('admin.daily_schedules.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ order })
            });
        }
    });
});
</script>
@endsection
