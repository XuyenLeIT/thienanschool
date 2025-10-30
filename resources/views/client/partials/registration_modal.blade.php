<link rel="stylesheet" href="{{ asset('css/root.css') }}">

<style>
    /* Mobile scroll & input focus style */
    @media (max-width: 767px) {
        #registrationModal .modal-body {
            max-height: 80vh;
            overflow-y: auto;
        }
    }

    /* Header Gradient */
    #registrationModal .modal-header {
        background: linear-gradient(45deg, var(--main-light), var(--main-accent));
        color: #6b3e2e;
        /* chữ nâu dịu hơn */
        border-bottom: none;
    }

    /* Nút đóng */
    #registrationModal .btn-close {
        filter: invert(0.5);
    }

    /* Body Gradient nhạt hơn */
    #registrationModal .modal-body {
        background: linear-gradient(180deg, #fff, var(--main-light));
    }

    /* Nút Submit */
    #registrationModal .btn-submit {
        background: var(--primary-color);
        border: none;
        color: #6b3e2e;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    #registrationModal .btn-submit:hover {
        background: var(--main-accent-hover);
        transform: scale(1.03);
        box-shadow: 0 4px 10px rgba(252, 182, 159, 0.4);
    }

    /* Hover & focus input/textarea */
    #registrationModal .form-control:focus,
    #registrationModal .form-select:focus,
    #registrationModal textarea:focus {
        border-color: var(--main-accent);
        box-shadow: 0 0 0 0.2rem rgba(252, 182, 159, 0.25);
        outline: none;
    }
</style>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header rounded-top-4">
                <h5 class="modal-title fw-bold" id="registrationModalLabel">📬 Đăng ký trực tuyến</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4 p-md-5 rounded-bottom-4">
                <form id="registrationForm" class="row g-3">
                    <!-- Họ tên phụ huynh -->
                    <div class="col-md-6">
                        <label for="parentName" class="form-label fw-semibold">Họ tên phụ huynh</label>
                        <input type="text" class="form-control form-control-lg" id="parentName"
                            placeholder="Nhập họ tên..." required style="border-radius: 0.5rem;">
                    </div>

                    <!-- Số điện thoại -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                        <input type="tel" class="form-control form-control-lg" id="phone"
                            placeholder="Nhập số điện thoại..." required style="border-radius: 0.5rem;">
                    </div>

                    <!-- Họ tên bé -->
                    <div class="col-md-6">
                        <label for="childName" class="form-label fw-semibold">Họ tên bé</label>
                        <input type="text" class="form-control form-control-lg" id="childName"
                            placeholder="Nhập tên bé..." required style="border-radius: 0.5rem;">
                    </div>

                    <!-- Độ tuổi -->
                    <div class="col-md-6">
                        <label for="ageGroup" class="form-label fw-semibold">Độ tuổi</label>
                        <select class="form-select form-select-lg" id="ageGroup" required
                            style="border-radius: 0.5rem;">
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
                        <textarea class="form-control form-control-lg" id="note" rows="3" placeholder="Nhập ghi chú nếu có..."
                            style="border-radius: 0.5rem;"></textarea>
                    </div>

                    <!-- Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-submit btn-lg px-5 shadow-sm w-100 w-md-auto"
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("registrationForm");
        const btn = document.getElementById("submitBtn");
        const btnText = document.getElementById("btnText");
        const btnSpinner = document.getElementById("btnSpinner");

        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            const data = {
                parent_name: document.getElementById("parentName").value.trim(),
                phone: document.getElementById("phone").value.trim(),
                child_name: document.getElementById("childName").value.trim(),
                age_group: document.getElementById("ageGroup").value,
                note: document.getElementById("note").value.trim(),
            };

            // Loading state
            btn.disabled = true;
            btnText.textContent = "Đang gửi...";
            btnSpinner.classList.remove("d-none");

            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                const response = await fetch("/api/register", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || "Gửi thất bại!");
                }

                // 🎉 Thông báo SweetAlert khi thành công
                await Swal.fire({
                    icon: "success",
                    title: "Thành công!",
                    text: result.message,
                    confirmButtonColor: "#fcb69f",
                    confirmButtonText: "Đóng",
                    timer: 4500,
                    timerProgressBar: true
                });

                // Reset form & đóng modal
                form.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById(
                    "registrationModal"));
                if (modal) modal.hide();

            } catch (error) {
                console.error(error);
                // ❌ Thông báo lỗi
                Swal.fire({
                    icon: "error",
                    title: "Lỗi!",
                    text: error.message || "Đã có lỗi xảy ra, vui lòng thử lại.",
                    confirmButtonColor: "#f87171",
                    confirmButtonText: "Đóng"
                });
            } finally {
                btn.disabled = false;
                btnText.textContent = "Gửi đăng ký";
                btnSpinner.classList.add("d-none");
            }
        });
    });
</script>
