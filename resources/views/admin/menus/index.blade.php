@extends('admin.layout.app')
@section('title', 'Danh sách Menu')

@section('content')
<style>
    /* --- PHẦN CHUNG --- */
    #previewLayout {
        position: relative;
        padding: 20px;
        border: 8px solid #f1c40f;
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }

    .overlay-text-top {
        background: rgba(0, 0, 0, 0.6);
        padding: 15px 30px;
        border-radius: 12px;
        display: inline-block;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
    }

    .school-name {
        font-size: 2rem;
        font-weight: 700;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 5px;
    }

    .week-range {
        font-size: 1.1rem;
        font-style: italic;
        color: #f8f8f8;
    }

    .hide-during-export {
        display: none !important;
    }

    /* --- LAYOUT 4️⃣ MODERN --- */
    .layout-modern .menu-day {
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 15px;
        background: #fdfdfd;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .layout-modern .menu-day h5 {
        background: #007bff;
        color: #fff;
        border-radius: 12px;
        padding: 8px;
        margin-bottom: 10px;
    }

    /* --- LAYOUT 5️⃣ CUTE --- */
    .layout-cute .menu-day {
        border-radius: 20px;
        padding: 20px;
        background: linear-gradient(135deg, #f9d6e4, #f6f1c0);
        color: #333;
        font-family: 'Comic Sans MS', cursive;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    .layout-cute .menu-day h5 {
        color: #e84393;
        font-size: 1.4rem;
    }

    /* --- LAYOUT 6️⃣ CLASSIC --- */
    .layout-classic .menu-day {
        border: 2px solid #d4af37;
        background: #fffbea;
        border-radius: 10px;
        padding: 15px;
        box-shadow: inset 0 0 10px rgba(212, 175, 55, 0.3);
    }

    .layout-classic h5 {
        color: #b8860b;
        font-weight: bold;
    }
</style>

<div class="container py-4">
    <h2 class="mb-4">Danh sách Thực đơn hàng tuần</h2>
    <a href="{{ route('manager.menus.create') }}" class="btn btn-primary mb-2">
        <i class="fa fa-plus"></i> Thêm Menu
    </a>

    <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
        <div>
            <label class="fw-bold me-2">Chọn Tuần:</label>
            <select id="weekSelect" class="form-select d-inline-block w-auto">
                <option value="current" {{ request('week') != 'next' ? 'selected' : '' }}>📅 Tuần hiện tại</option>
                <option value="next" {{ request('week') == 'next' ? 'selected' : '' }}>➡️ Tuần tới</option>
            </select>
        </div>

        <div>
            <label for="layoutSelect" class="me-2 fw-bold">Chọn Layout:</label>
            <select id="layoutSelect" class="form-select d-inline-block w-auto">
                <option value="table">📋 Bảng truyền thống</option>
                <option value="card">🪪 Thẻ từng ngày</option>
                <option value="poster">🖼️ Poster đẹp</option>
                <option value="modern">✨ Hiện đại</option>
                <option value="cute">🧸 Dễ thương</option>
                <option value="classic">🏛️ Cổ điển</option>
            </select>
        </div>

        <div>
            <label for="bgSelect" class="me-2 fw-bold">Chọn Nền:</label>
            <select id="bgSelect" class="form-select d-inline-block w-auto">
                <option value="">— Không có nền —</option>
                <option value="{{ asset('menus/f1.jpg') }}">🌅 Mẫu 1</option>
                <option value="{{ asset('menus/f2.jpg') }}">🌿 Mẫu 2</option>
                <option value="{{ asset('menus/f3.jpg') }}">🌸 Mẫu 3</option>
                <option value="{{ asset('menus/f4.jpg') }}">🍎 Mẫu 4</option>
                <option value="{{ asset('menus/f5.jpg') }}">🌈 Mẫu 5</option>
            </select>
        </div>

        <button id="exportImageBtn" class="btn btn-success">
            <i class="fa fa-image"></i> Xuất ảnh
        </button>
    </div>

    <div id="previewLayout" class="p-3 rounded shadow-sm position-relative">
        <div class="overlay-text-top text-center mb-4">
            <h3 class="school-name">Trường Mầm Non Thiên Ân</h3>
            <p class="week-range">Thực đơn áp dụng: {{ $weekRange }}</p>
        </div>

        {{-- TABLE --}}
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
                                <a href="{{ route('manager.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('manager.menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CARD --}}
        <div id="layout-card" class="d-none row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach ($menus as $menu)
            <div class="col">
                <div class="card h-100 border-0 shadow">
                    <div class="card-header bg-primary text-white fw-bold text-center">{{ $menu->day }}</div>
                    <div class="card-body">
                        <p><b>🍞 Sáng:</b> {{ $menu->breakfast }}</p>
                        <p><b>🍲 Trưa:</b> {{ $menu->lunch }}</p>
                        <p><b>🍪 Xế:</b> {{ $menu->snack }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- POSTER --}}
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

        {{-- MODERN --}}
        <div id="layout-modern" class="d-none layout-modern row row-cols-1 row-cols-md-3 g-3">
            @foreach ($menus as $menu)
            <div class="col">
                <div class="menu-day">
                    <h5>{{ $menu->day }}</h5>
                    <p>🍞 {{ $menu->breakfast }}</p>
                    <p>🍲 {{ $menu->lunch }}</p>
                    <p>🍪 {{ $menu->snack }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CUTE --}}
        <div id="layout-cute" class="d-none layout-cute row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach ($menus as $menu)
            <div class="col">
                <div class="menu-day">
                    <h5>🐻 {{ $menu->day }}</h5>
                    <p>🍞 {{ $menu->breakfast }}</p>
                    <p>🍲 {{ $menu->lunch }}</p>
                    <p>🍪 {{ $menu->snack }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CLASSIC --}}
        <div id="layout-classic" class="d-none layout-classic row row-cols-1 row-cols-md-3 g-3">
            @foreach ($menus as $menu)
            <div class="col">
                <div class="menu-day text-center">
                    <h5>{{ $menu->day }}</h5>
                    <p>🍞 {{ $menu->breakfast }}</p>
                    <p>🍲 {{ $menu->lunch }}</p>
                    <p>🍪 {{ $menu->snack }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="alert alert-info mt-3">
        <strong>Lưu ý:</strong> Thực đơn có thể thay đổi theo tuần. Hãy kiểm tra và cập nhật thường xuyên.
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dom-to-image-more@3.3.0/dist/dom-to-image-more.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('sortable');
    const preview = document.getElementById('previewLayout');

    // ✅ Kéo-thả để sắp xếp
    if (el) {
        Sortable.create(el, {
            animation: 150,
            handle: 'td',
            onEnd: function () {
                const order = Array.from(el.children).map(row => {
                    const id = row.querySelector('a.btn-warning')?.href.match(/\/(\d+)\/edit/)?.[1];
                    return id ? parseInt(id) : null;
                }).filter(Boolean);

                fetch("{{ route('manager.menus.sort') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ order })
                }).then(res => res.json())
                .then(data => showToast("Đã lưu thứ tự mới!", "success"))
                .catch(() => showToast("Lỗi khi lưu thứ tự!", "danger"));
            }
        });
    }

    // ✅ Đổi layout
    const layouts = ['table', 'card', 'poster', 'modern', 'cute', 'classic'];
    document.getElementById('layoutSelect').addEventListener('change', e => {
        layouts.forEach(l => document.getElementById(`layout-${l}`).classList.add('d-none'));
        document.getElementById(`layout-${e.target.value}`).classList.remove('d-none');
    });

    // ✅ Đổi nền
    document.getElementById('bgSelect').addEventListener('change', e => {
        preview.style.backgroundImage = e.target.value ? `url('${e.target.value}')` : '';
    });

    // ✅ Đổi tuần
    document.getElementById('weekSelect').addEventListener('change', e => {
        const url = new URL(window.location.href);
        if (e.target.value === 'next') url.searchParams.set('week', 'next');
        else url.searchParams.delete('week');
        window.location.href = url.toString();
    });

    // ✅ Xuất ảnh có loading
    document.getElementById('exportImageBtn').addEventListener('click', async () => {
        const btn = document.getElementById('exportImageBtn');
        const originalHTML = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = `<i class="fa fa-spinner fa-spin"></i> Đang xuất ảnh...`;

        document.querySelectorAll('.no-export').forEach(el => el.classList.add('hide-during-export'));

        try {
            const blob = await domtoimage.toBlob(preview, { bgcolor: 'white', quality: 1 });
            const link = document.createElement('a');
            link.download = 'thucdon-thienan.png';
            link.href = URL.createObjectURL(blob);
            link.click();
            showToast("✅ Xuất ảnh thành công!", "success");
        } catch (err) {
            showToast("❌ Không thể xuất ảnh, vui lòng thử lại!", "danger");
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
            document.querySelectorAll('.no-export').forEach(el => el.classList.remove('hide-during-export'));
        }
    });

    // ✅ Toast thông báo
    function showToast(message, type = "info") {
        const toast = document.createElement("div");
        toast.className = `toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3`;
        toast.role = "alert";
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>`;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
        bsToast.show();
        toast.addEventListener("hidden.bs.toast", () => toast.remove());
    }
});
</script>
@endsection
