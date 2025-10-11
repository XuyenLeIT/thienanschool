@extends('admin.layout.app')
@section('title', 'Danh sách Menu')

@section('content')
<style>
    /* ✅ Ép toàn bộ màu trở về RGB khi export ảnh */
.exporting, .exporting * {
    color-scheme: only light;
    color: rgb(0, 0, 0) !important;
    background-color: transparent !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    box-shadow: none !important;
}

    /* Khung bao quanh toàn bộ thực đơn */
#previewLayout {
    position: relative;
    padding: 20px;
    border: 8px solid #f1c40f;               /* màu vàng nhạt */
    border-radius: 20px;                     /* bo tròn góc */
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);  /* bóng đổ */
    background-size: cover;
    background-position: center;
    overflow: hidden;                         /* tránh phần tử tràn ra ngoài */
}
/* 🔥 Overlay tiêu đề */
.overlay-text-top {
    background: rgba(0,0,0,0.6);       /* Nền mờ để chữ nổi bật */
    padding: 15px 30px;
    border-radius: 12px;
    display: inline-block;             /* Gói gọn theo nội dung */
    text-align: center;
    color: #fff;

    /* 👉 Canh giữa */
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 20px;
}

.school-name {
    font-size: 2.2rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    margin-bottom: 6px;
}

.week-range {
    font-size: 1.2rem;
    font-style: italic;
    margin: 0;
    color: #f5f5f5;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
}


/* Ẩn nút Edit/Delete khi xuất ảnh */
.no-export {
    display: table-cell;
}
.hide-during-export {
    display: none !important;
}

</style>
<div class="container py-4">
    <h2 class="mb-4">Danh sách Thực đơn hàng tuần</h2>

    {{-- Thanh công cụ --}}
    <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
        <div>
            <label for="layoutSelect" class="me-2 fw-bold">Chọn Layout: </label>
            <select id="layoutSelect" class="form-select d-inline-block w-auto">
                <option value="table">📋 Bảng truyền thống</option>
                <option value="card">🪪 Thẻ từng ngày</option>
                <option value="poster">🖼️ Poster đẹp</option>
            </select>
        </div>

        <div>
            <label for="bgSelect" class="me-2 fw-bold">Chọn Nền:</label>
            <select id="bgSelect" class="form-select d-inline-block w-auto">
                <option value="">— Không có nền —</option>
                <option value="{{ asset('menus/f1.jpeg') }}">Mẫu 1</option>
                <option value="{{ asset('menus/f2.jpg') }}">Mẫu 2</option>
                <option value="{{ asset('menus/f4.jpg') }}">Mẫu 3</option>
            </select>
        </div>

        <button id="exportImageBtn" class="btn btn-success">
            <i class="fa fa-image"></i> Xuất ảnh
        </button>
    </div>

    {{-- Khu vực Preview --}}
    <div id="previewLayout" class="p-3 rounded shadow-sm position-relative"
         style="background-size: cover; background-position: center;">

        {{-- 🔥 Overlay để chữ rõ ràng hơn --}}
        <div class="overlay-text-top text-center mb-4">
            <h3 class="school-name">Trường Mầm Non Thiên Ân</h3>
            <p class="week-range">Thực đơn áp dụng: {{ $weekRange }}</p>
        </div>

        {{-- Layout TABLE --}}
        <div id="layout-table">
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Ngày</th>
                            <th>Sáng</th>
                            <th>Trưa</th>
                            <th>Xế</th>
                            <th class="no-export">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($menus as $menu)
                        <tr>
                            <td class="fw-bold">{{ $menu->day }}</td>
                            <td>{{ $menu->breakfast }}</td>
                            <td>{{ $menu->lunch }}</td>
                            <td>{{ $menu->snack }}</td>
                            <td class="no-export text-center">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Layout CARD --}}
        <div id="layout-card" class="d-none row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach ($menus as $menu)
            <div class="col">
                <div class="card h-100 border-0 shadow">
                    <div class="card-header bg-primary text-white fw-bold text-center">
                        {{ $menu->day }}
                    </div>
                    <div class="card-body">
                        <p><strong>🍞 Sáng:</strong> {{ $menu->breakfast }}</p>
                        <p><strong>🍲 Trưa:</strong> {{ $menu->lunch }}</p>
                        <p><strong>🍪 Xế:</strong> {{ $menu->snack }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Layout POSTER --}}
        <div id="layout-poster" class="d-none text-center text-white">
            <div class="row row-cols-1 row-cols-md-3 g-3">
                @foreach ($menus as $menu)
                <div class="col">
                    <div class="p-3 border rounded bg-light text-dark shadow-sm">
                        <h5 class="fw-bold text-primary">{{ $menu->day }}</h5>
                        <p>🍞 <b>Sáng:</b> {{ $menu->breakfast }}</p>
                        <p>🍲 <b>Trưa:</b> {{ $menu->lunch }}</p>
                        <p>🍪 <b>Xế:</b> {{ $menu->snack }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lưu ý --}}
    <div class="alert alert-info mt-3">
        <strong>Lưu ý:</strong> Thực đơn có thể thay đổi theo tuần. Vui lòng kiểm tra và cập nhật thường xuyên để đảm bảo thông tin chính xác.
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sortable
    const el = document.getElementById('sortable');
    if (el) {
        Sortable.create(el, {
            animation: 150
        });
    }

    // Chọn Layout
    document.getElementById('layoutSelect').addEventListener('change', (e) => {
        ['table','card','poster'].forEach(l => {
            document.getElementById(`layout-${l}`).classList.add('d-none');
        });
        document.getElementById(`layout-${e.target.value}`).classList.remove('d-none');
    });

    // Chọn nền
    document.getElementById('bgSelect').addEventListener('change', (e) => {
        const preview = document.getElementById('previewLayout');
        preview.style.backgroundImage = e.target.value ? `url('${e.target.value}')` : '';
    });

    // Xuất ảnh
    document.getElementById('exportImageBtn').addEventListener('click', () => {
        document.querySelectorAll('.no-export').forEach(el => el.classList.add('hide-during-export'));

        html2canvas(document.getElementById('previewLayout'), {
            scale: 2,
            useCORS: true,
            backgroundColor: null,
        }).then(canvas => {
            const link = document.createElement('a');
            link.download = 'menu-layout.png';
            link.href = canvas.toDataURL('image/png');
            link.click();

            document.querySelectorAll('.no-export').forEach(el => el.classList.remove('hide-during-export'));
        });
    });
});
</script>
@endsection
