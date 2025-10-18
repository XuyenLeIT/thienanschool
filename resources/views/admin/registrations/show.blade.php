@extends('admin.layout.app')

@section('title', 'Chi tiết đăng ký')

@section('content')
<style>
    /* 🌸 Tổng thể nhẹ nhàng hơn */
    body {
        background-color: #fffaf5;
    }

    .registration-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        border: 3px solid #ffe5c2;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    /* 🎀 Ảnh hoạt hình nền */
    .registration-card::before {
        content: "";
        background: url('https://cdn-icons-png.flaticon.com/512/2925/2925535.png') no-repeat bottom right;
        background-size: 150px;
        opacity: 0.2;
        position: absolute;
        right: 10px;
        bottom: 10px;
        width: 150px;
        height: 150px;
    }

    .section-title {
        font-family: 'Comic Sans MS', cursive;
        color: #ff8c42;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .info-label {
        color: #ff6b6b;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #ff9f43;
        border-color: #ff9f43;
    }

    .btn-primary:hover {
        background-color: #ff793f;
        border-color: #ff793f;
    }

    #toggle-form-btn {
        background-color: #6c63ff;
        border-color: #6c63ff;
    }

    #toggle-form-btn:hover {
        background-color: #5548e5;
    }

    .cute-image {
        width: 120px;
        display: block;
        margin: 0 auto 20px;
    }

    #result-form-card {
        background-color: #fffdf7;
        border: 2px dashed #ffd6a5;
        border-radius: 15px;
    }
</style>

<div class="container py-5">
    <h2 class="section-title">📋 Chi tiết đăng ký #{{ $registration->id }}</h2>

    <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="cute cartoon" class="cute-image">

    <div class="text-center mb-4">
        <a href="{{ route($authUser->role . '.registrations.index') }}" class="btn btn-secondary px-4">← Quay lại danh sách</a>
    </div>

    <div class="registration-card mb-4">
        <p><span class="info-label">👨‍👩‍👧 Họ tên phụ huynh:</span> {{ $registration->parent_name }}</p>
        <p><span class="info-label">📞 Số điện thoại:</span> {{ $registration->phone }}</p>
        <p><span class="info-label">👶 Họ tên bé:</span> {{ $registration->child_name }}</p>
        <p><span class="info-label">🎂 Độ tuổi:</span> {{ $registration->age_group }}</p>
        <p><span class="info-label">📝 Ghi chú:</span> {{ $registration->note ?? '-' }}</p>
        <p><span class="info-label">📅 Ngày đăng ký:</span> {{ $registration->created_at->format('d/m/Y H:i') }}</p>
        <p><span class="info-label">📌 Trạng thái:</span>
            <span id="status-badge" class="badge {{ $registration->status ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ $registration->status ? 'Đã liên hệ' : 'Chưa liên hệ' }}
            </span>
        </p>
        <p><span class="info-label">🎯 Kết quả:</span>
            <span id="result-text">
                @if ($registration->result === null)
                    -
                @elseif($registration->result)
                    Đã liên hệ - Bé đồng ý nhập học
                @else
                    Thất bại - Đang tham khảo
                @endif
            </span>
        </p>
        <p><span class="info-label">💬 Ghi chú kết quả:</span>
            <span id="note-result-text">{{ $registration->note_result ?? '-' }}</span>
        </p>
    </div>

    @if ($authUser->role === 'manager')
        <button id="toggle-form-btn" class="btn btn-primary mb-3 w-100">
            ✏️ Cập nhật kết quả liên hệ
        </button>
    @endif

    {{-- Form cập nhật --}}
    <div id="result-form-card" class="card shadow-sm p-4" style="display: none;">
        <h5 class="mb-3">🧸 Ghi chú kết quả liên hệ</h5>
        <form id="updateResultForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái liên hệ</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="0" {{ $registration->status ? '' : 'selected' }}>Chưa liên hệ</option>
                    <option value="1" {{ $registration->status ? 'selected' : '' }}>Đã liên hệ</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="result" class="form-label">Kết quả liên hệ</label>
                <select name="result" id="result" class="form-select">
                    <option value="">-- Chọn kết quả --</option>
                    <option value="1" {{ $registration->result ? 'selected' : '' }}>Đã liên hệ - Bé đồng ý nhập học</option>
                    <option value="0" {{ !$registration->result && $registration->status ? 'selected' : '' }}>Thất bại - Đang tham khảo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="note_result" class="form-label">Ghi chú thêm</label>
                <textarea name="note_result" id="note_result" rows="3" class="form-control">{{ $registration->note_result ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-success w-100" id="submitBtn">💾 Cập nhật kết quả</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-form-btn');
        const formCard = document.getElementById('result-form-card');
        const form = document.getElementById('updateResultForm');
        const submitBtn = document.getElementById('submitBtn');
        const registrationId = {{ $registration->id }};
        const userRole = "{{ $authUser->role }}";

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                formCard.style.display = formCard.style.display === 'none' ? 'block' : 'none';
                toggleBtn.textContent = formCard.style.display === 'block'
                    ? '🔒 Ẩn form cập nhật'
                    : '✏️ Cập nhật kết quả liên hệ';
            });
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.textContent = 'Đang cập nhật...';

            const data = {
                status: document.getElementById('status').value,
                result: document.getElementById('result').value,
                note_result: document.getElementById('note_result').value
            };

            try {
                const res = await fetch(`/${userRole}/registrations/${registrationId}/update-result`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                const result = await res.json();

                if (res.ok) {
                    document.getElementById('status-badge').textContent =
                        data.status == 1 ? 'Đã liên hệ' : 'Chưa liên hệ';
                    document.getElementById('status-badge').className =
                        data.status == 1 ? 'badge bg-success' : 'badge bg-warning text-dark';
                    document.getElementById('result-text').textContent =
                        data.result === "" ? "-" :
                        data.result == 1 ? 'Đã liên hệ - Bé đồng ý nhập học' : 'Thất bại - Đang tham khảo';
                    document.getElementById('note-result-text').textContent =
                        data.note_result || '-';

                    Swal.fire({
                        icon: 'success',
                        title: result.message || 'Cập nhật thành công!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('Lỗi!', 'Cập nhật thất bại, thử lại.', 'error');
                }
            } catch (err) {
                console.error(err);
                Swal.fire('Lỗi!', 'Cập nhật thất bại, thử lại.', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '💾 Cập nhật kết quả';
            }
        });
    });
</script>
@endsection
