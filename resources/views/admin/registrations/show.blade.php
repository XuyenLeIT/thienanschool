@extends('admin.layout.app')

@section('title', 'Chi tiết đăng ký')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Chi tiết đăng ký #{{ $registration->id }}</h2>

        <div class="card shadow-sm p-4 mb-4">
            <p><strong>Họ tên phụ huynh:</strong> {{ $registration->parent_name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $registration->phone }}</p>
            <p><strong>Họ tên bé:</strong> {{ $registration->child_name }}</p>
            <p><strong>Độ tuổi:</strong> {{ $registration->age_group }}</p>
            <p><strong>Ghi chú:</strong> {{ $registration->note ?? '-' }}</p>
            <p><strong>Trạng thái:</strong>
                <span id="status-badge" class="badge {{ $registration->status ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $registration->status ? 'Đã liên hệ' : 'Chưa liên hệ' }}
                </span>
            </p>
            <p><strong>Ngày đăng ký:</strong> {{ $registration->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Kết quả:</strong>
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
            <p><strong>Ghi chú kết quả:</strong> <span id="note-result-text">{{ $registration->note_result ?? '-' }}</span>
            </p>

        </div>

        <button id="toggle-form-btn" class="btn btn-primary mb-3">Cập nhật kết quả liên hệ</button>

        {{-- Form cập nhật kết quả liên hệ ẩn ban đầu --}}
        <div id="result-form-card" class="card shadow-sm p-4" style="display: none;">
            <h5>Ghi chú kết quả liên hệ</h5>
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
                        <option value="1" {{ $registration->result ? 'selected' : '' }}>Đã liên hệ - Bé đồng ý nhập
                            học</option>
                        <option value="0" {{ !$registration->result && $registration->status ? 'selected' : '' }}>Thất
                            bại - Đang tham khảo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="note_result" class="form-label">Ghi chú thêm</label>
                    <textarea name="note_result" id="note_result" rows="3" class="form-control">{{ $registration->note_result ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-success" id="submitBtn">Cập nhật kết quả</button>
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

            toggleBtn.addEventListener('click', () => {
                formCard.style.display = formCard.style.display === 'none' ? 'block' : 'none';
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.textContent = 'Đang cập nhật...';

                const data = {
                    status: document.getElementById('status').value,
                    result: document.getElementById('result').value,
                    note_result: document.getElementById('note_result').value,
                    _token: "{{ csrf_token() }}",
                    _method: "PUT"
                };

                try {
                    const res = await fetch(
                        "{{ route('admin.registrations.updateResult', $registration->id) }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        });

                    const result = await res.json();

                    if (res.ok) {
                        // Update UI trực tiếp
                        const statusBadge = document.getElementById('status-badge');
                        const resultText = document.getElementById('result-text');
                        const noteResultText = document.getElementById('note-result-text');

                        statusBadge.textContent = data.status == 1 ? 'Đã liên hệ' : 'Chưa liên hệ';
                        statusBadge.className = data.status == 1 ? 'badge bg-success' :
                            'badge bg-warning text-dark';

                        if (data.result === "") {
                            resultText.textContent = "-";
                        } else {
                            resultText.textContent = data.result == 1 ?
                                'Đã liên hệ - Bé đồng ý nhập học' : 'Thất bại - Đang tham khảo';
                        }

                        noteResultText.textContent = data.note_result || '-';

                        Swal.fire({
                            icon: 'success',
                            title: 'Cập nhật thành công!',
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
                    submitBtn.textContent = 'Cập nhật kết quả';
                }
            });
        });
    </script>
@endsection
