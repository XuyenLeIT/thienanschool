@extends('client.layout.app')

@section('title', 'Phụ huynh - Trường Mầm Non Thiên Ân')

@section('content')
    <!-- Hero -->
    @if ($carausel)
        <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center"
            style="background: url('{{ asset($carausel->image) }}') no-repeat center center; background-size: cover; min-height: 50vh; position: relative;">
            <div class="hero-overlay" style="position:absolute; inset:0; background: rgba(0,0,0,0.4);"></div>
            <div style="position: relative; z-index: 2;">
                <h1 data-aos="fade-up">{{ $carausel->title }}</h1>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">
                    {{ $carausel->description }}
                </p>
            </div>
        </section>
    @endif

    <!-- Thông tin liên hệ -->
    <section class="container py-5">
        <h2 class="section-title text-center mb-4" data-aos="fade-up">📍 Thông tin trường</h2>
        <div class="row g-4 align-items-center">
            <div class="col-md-6 contact-info" data-aos="fade-right">
                <div class="p-4 bg-light rounded shadow-sm">
                    <p><i class="bi bi-geo-alt-fill text-danger"></i> <b>Địa chỉ:</b> 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p><i class="bi bi-telephone-fill text-success"></i> <b>Điện thoại:</b> 0123 456 789</p>
                    <p><i class="bi bi-envelope-fill text-primary"></i> <b>Email:</b> lienhe@thienan.edu.vn</p>
                    <p><i class="bi bi-facebook text-info"></i> <b>Fanpage:</b>
                        <a href="#" target="_blank">facebook.com/mamnonthienan</a>
                    </p>
                    <p><i class="bi bi-chat-dots-fill text-warning"></i> <b>Zalo:</b> 0123 456 789</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <!-- Google Map -->
                <div class="rounded overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5025!2d106.700423!3d10.776889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3a123456%3A0xabcdef!2zVHLGsOG7nW5nIE3huqdtIE5vbg!5e0!3m2!1svi!2s!4v1690000000000!5m2!1svi!2s"
                        width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Form liên hệ -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5" data-aos="fade-up">
                📬 Gửi tin nhắn cho chúng tôi
            </h2>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0" data-aos="zoom-in">
                        <div class="card-body p-5">
                            <form id="registrationForm" class="row g-4">
                                <div class="col-md-6">
                                    <label for="parentName" class="form-label fw-semibold">Họ tên phụ huynh</label>
                                    <input type="text" name="parent_name" class="form-control form-control-lg"
                                        id="parentName" placeholder="Nhập họ tên..." required>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                    <input type="tel" name="phone" class="form-control form-control-lg" id="phone"
                                        placeholder="Nhập số điện thoại..." required>
                                </div>

                                <div class="col-md-6">
                                    <label for="childName" class="form-label fw-semibold">Họ tên bé</label>
                                    <input type="text" name="child_name" class="form-control form-control-lg"
                                        id="childName" placeholder="Nhập tên bé..." required>
                                </div>

                                <div class="col-md-6">
                                    <label for="ageGroup" class="form-label fw-semibold">Độ tuổi</label>
                                    <select name="age_group" class="form-select form-select-lg" id="ageGroup" required>
                                        <option selected disabled value="">Chọn độ tuổi...</option>
                                        <option value="nha-tre">Nhà trẻ (12–36 tháng)</option>
                                        <option value="mau-giao-be">Mẫu giáo bé (3–4 tuổi)</option>
                                        <option value="mau-giao-nho">Mẫu giáo nhỡ (4–5 tuổi)</option>
                                        <option value="mau-giao-lon">Mẫu giáo lớn (5–6 tuổi)</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="note" class="form-label fw-semibold">Ghi chú thêm</label>
                                    <textarea name="note" class="form-control form-control-lg" id="note" rows="3"
                                        placeholder="Nhập ghi chú nếu có..."></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm" id="submitBtn">
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
        </div>
    </section>
@endsection

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registrationForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable button + show spinner
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
                // Enable button + hide spinner
                submitBtn.disabled = false;
                btnText.classList.remove('d-none');
                btnSpinner.classList.add('d-none');
            }
        });
    });
</script>
