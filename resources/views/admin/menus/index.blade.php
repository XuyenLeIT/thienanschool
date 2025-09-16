@extends('admin.layout.app')
@section('title', 'Danh sách Menu')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách Thực đơn hàng tuần</h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle" id="menuTable">
            <thead class="table-primary">
                <tr>
                    <th>Ngày</th>
                    <th>Sáng</th>
                    <th>Trưa</th>
                    <th>Xế</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach ($menus as $menu)
                    <tr data-id="{{ $menu->id }}">
                        <td>{{ $menu->day }}</td>
                        <td>{{ $menu->breakfast }}</td>
                        <td>{{ $menu->lunch }}</td>
                        <td>{{ $menu->snack }}</td>
                        <td>
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xóa không?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Lưu ý --}}
    <div class="alert alert-info mt-3">
        <strong>Lưu ý:</strong> Thực đơn có thể thay đổi theo tuần. Vui lòng kiểm tra và cập nhật thường xuyên để đảm bảo thông tin chính xác cho phụ huynh.
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('sortable');
    Sortable.create(el, {
        animation: 150,
        onEnd: function() {
            const order = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
            fetch("{{ route('admin.menus.sort') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order })
            })
            .then(res => res.json())
            .then(data => console.log('Thứ tự cập nhật thành công:', data))
            .catch(err => console.error(err));
        }
    });
});
</script>
@endsection
