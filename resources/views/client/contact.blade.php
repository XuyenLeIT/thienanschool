@extends('client.layout.app')

@section('title', 'Phụ huynh - Trường Mầm Non Thiên Ân')


@section('content')
    <style>
        /* Căn chỉnh input/card */
        #contactForm input,
        #contactForm select,
        #contactForm textarea {
            border-radius: 0.5rem;
            padding: 0.6rem 0.8rem;
            border: 1px solid #ced4da;
            width: 100%;
        }

        /* Hover & focus effect */
        #contactForm input:focus,
        #contactForm select:focus,
        #contactForm textarea:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            outline: none;
        }

        /* Responsive trên mobile */
        @media (max-width: 767px) {

            #contactForm input,
            #contactForm select,
            #contactForm textarea {
                font-size: 1rem;
            }

            #contactForm button {
                width: 100% !important;
            }

            #contactForm .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
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
        <h2 class="section-title text-center mb-5 fw-bold" data-aos="fade-up">
            📍 Thông tin Trường Mầm Non Thiên Ân
        </h2>

        <div class="row g-4">
            <!-- Thông tin liên hệ -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="p-4 bg-white rounded-3 shadow-lg h-100">
                    <h5 class="mb-4 text-primary fw-semibold">Liên hệ nhanh</h5>

                    <!-- Địa chỉ -->
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill text-danger fs-4 me-3"></i>
                        <div>
                            <strong>Địa chỉ:</strong><br>
                            123 Đường ABC, Quận 1, TP.HCM
                        </div>
                    </div>

                    <!-- Số điện thoại cô 1 -->
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-telephone-fill text-success fs-4 me-3"></i>
                        <div>
                            <strong>Cô Ngọc:</strong><br>
                            <a href="tel:0912345678" class="text-decoration-none text-dark">
                                0982 563 652
                            </a>
                        </div>
                    </div>

                    <!-- Số điện thoại cô 2 -->
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-telephone-fill text-success fs-4 me-3"></i>
                        <div>
                            <strong>Cô Oanh:</strong><br>
                            <a href="tel:0987654321" class="text-decoration-none text-dark">
                                0382 907 702
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-envelope-fill text-primary fs-4 me-3"></i>
                        <div>
                            <strong>Email:</strong><br>
                            <a href="mailto:lienhe@thienan.edu.vn" class="text-decoration-none text-dark">
                                lienhe@thienan.edu.vn
                            </a>
                        </div>
                    </div>

                    <!-- Fanpage -->
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-facebook text-primary fs-4 me-3"></i>
                        <div>
                            <strong>Fanpage:</strong><br>
                            <a href="https://www.facebook.com/profile.php?id=100012383971736" target="_blank"
                                class="btn btn-sm btn-primary rounded-pill px-3 mt-1">
                                <i class="bi bi-facebook me-1"></i> Theo dõi Fanpage
                            </a>
                        </div>
                    </div>

                    <!-- Zalo -->
                    <div class="d-flex align-items-start">
                        <i class="bi bi-chat-dots-fill text-info fs-4 me-3"></i>
                        <div>
                            <strong>Zalo:</strong><br>
                            <a href="https://zalo.me/0382907702" target="_blank"
                                class="btn btn-sm btn-outline-info rounded-pill px-3 mt-1">
                                Nhắn Zalo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bản đồ -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="rounded-3 overflow-hidden shadow-lg h-100">
             <iframe width="100%" height="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.9236368629836!2d106.63269337408795!3d10.817155858443055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529672a426409%3A0x1c6f178245395fa4!2zMTI0IMSQLiBUcuG6p24gVGjDoWkgVMO0bmcsIFBoxrDhu51uZyAxNSwgVMOibiBCw6xuaCwgSOG7kyBDaMOtIE1pbmggNzAwMDAsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1759391431302!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                        <div class="card-body p-3">
                            <form id="contactForm" class="row g-4">
                                <div class="col-md-6 col-12">
                                    <label for="parentName" class="form-label fw-semibold">Họ tên phụ huynh</label>
                                    <input type="text" name="parent_name" class="form-control form-control-lg"
                                        id="parentName" placeholder="Nhập họ tên..." required>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                    <input type="tel" name="phone" class="form-control form-control-lg" id="phone"
                                        placeholder="Nhập số điện thoại..." required>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="childName" class="form-label fw-semibold">Họ tên bé</label>
                                    <input type="text" name="child_name" class="form-control form-control-lg"
                                        id="childName" placeholder="Nhập tên bé..." required>
                                </div>

                                <div class="col-md-6 col-12">
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
                                    <button type="submit" class="btn btn-success btn-lg shadow-sm w-100 w-md-auto"
                                        id="submitBtn">
                                        <span id="btnText">Gửi đăng ký</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('client.partials.contact_icon')
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
