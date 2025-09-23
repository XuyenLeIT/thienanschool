{{-- resources/views/partials/registration-modal.blade.php --}}
<style>
    /* Mobile scroll & input focus style */
    @media (max-width: 767px) {
        #registrationModal .modal-body {
            max-height: 80vh; /* Chiều cao tối đa */
            overflow-y: auto; /* Scroll dọc nếu nội dung quá cao */
        }
    }

    /* Hover & focus input/textarea */
    #registrationModal .form-control:focus,
    #registrationModal .form-select:focus,
    #registrationModal textarea:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        outline: none;
    }
</style>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header bg-success text-white border-0 rounded-top-4">
                <h5 class="modal-title" id="registrationModalLabel">📬 Đăng ký trực tuyến</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4 p-md-5 bg-light rounded-bottom-4">
                <form id="registrationForm" class="row g-3">
                    <!-- Họ tên phụ huynh -->
                    <div class="col-md-6">
                        <label for="parentName" class="form-label fw-semibold">Họ tên phụ huynh</label>
                        <input type="text" class="form-control form-control-lg" id="parentName"
                            placeholder="Nhập họ tên..." required
                            style="border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                    </div>

                    <!-- Số điện thoại -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                        <input type="tel" class="form-control form-control-lg" id="phone"
                            placeholder="Nhập số điện thoại..." required
                            style="border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                    </div>

                    <!-- Họ tên bé -->
                    <div class="col-md-6">
                        <label for="childName" class="form-label fw-semibold">Họ tên bé</label>
                        <input type="text" class="form-control form-control-lg" id="childName"
                            placeholder="Nhập tên bé..." required
                            style="border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                    </div>

                    <!-- Độ tuổi -->
                    <div class="col-md-6">
                        <label for="ageGroup" class="form-label fw-semibold">Độ tuổi</label>
                        <select class="form-select form-select-lg" id="ageGroup" required
                            style="border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                            <option selected disabled value="">Chọn độ tuổi...</option>
                            <option value="nha-tre 12-36 tháng">Nhà trẻ (12–36 tháng)</option>
                            <option value="mau-giao-bé 3-4 tuổi">Mẫu giáo bé (3–4 tuổi)</option>
                            <option value="mau-giao-nhỏ 4-5 tuổi">Mẫu giáo nhỡ (4–5 tuổi)</option>
                            <option value="mau-giao-lớn 5-6 tuổi">Mẫu giáo lớn (5–6 tuổi)</option>
                        </select>
                    </div>

                    <!-- Ghi chú -->
                    <div class="col-12">
                        <label for="note" class="form-label fw-semibold">Ghi chú thêm</label>
                        <textarea class="form-control form-control-lg" id="note" rows="3"
                            placeholder="Nhập ghi chú nếu có..." 
                            style="border-radius: 0.5rem; padding: 0.5rem 0.75rem;"></textarea>
                    </div>

                    <!-- Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm w-100 w-md-auto"
                            id="submitBtn" style="border-radius: 0.5rem;">
                            <span id="btnText">Gửi đăng ký</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');

        const data = {
            parent_name: document.getElementById('parentName').value,
            phone: document.getElementById('phone').value,
            child_name: document.getElementById('childName').value,
            age_group: document.getElementById('ageGroup').value,
            note: document.getElementById('note').value,
        };

        try {
            const res = await fetch("{{ route('registration.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            const result = await res.json();

            if (res.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: result.message || 'Đăng ký thành công!',
                });
                form.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('registrationModal'));
                modal.hide();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: result.message || 'Có lỗi xảy ra, thử lại!',
                });
            }
        } catch (err) {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: 'Có lỗi xảy ra, thử lại!',
            });
        } finally {
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
        }
    });
});
</script>
