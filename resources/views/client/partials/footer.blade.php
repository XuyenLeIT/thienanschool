<style>
    .footer {
        background: linear-gradient(135deg, var(--main-light), var(--main-accent));
        color: var(--text-dark);
        position: relative;
    }

    .footer h5 {
        font-weight: bold;
    }

    .footer a {
        color: var(--text-dark);
        transition: color 0.3s ease-in-out;
    }

    .footer a:hover {
        color: var(--main-accent-hover);
    }

    .footer hr {
        border-color: rgba(255, 255, 255, 0.3);
    }

    .footer .btn-light {
        background: rgba(255, 255, 255, 0.9);
        color: var(--main-accent);
        transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .footer .btn-light:hover {
        background: var(--main-accent-hover);
        color: #fff;
        transform: translateY(-2px);
    }
</style>
<footer id="contact" class="footer pt-5 pb-3">
    <div class="container">
        <div class="row text-center text-md-start">
            <!-- Logo + giới thiệu -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">🌸 Trường Mầm Non Thiên Ân</h5>
                <p>
                    Nơi ươm mầm tri thức và tình yêu thương cho bé.
                    Chúng tôi cam kết mang đến môi trường học tập an toàn, sáng tạo và hạnh phúc.
                </p>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">📌 Thông tin liên hệ</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>124A Trần Thái Tông. Phường Tân Sơn (Phường 15. Tân Bình
                    cũ).</p>
                <p><i class="fas fa-phone me-2"></i>0382 907 702</p>
                <p><i class="fas fa-envelope me-2"></i>oanhdoanld@gmail.com</p>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">🔗 Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('contact') }}" class="text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>Liên hệ</a></li>
                    <li><a href="{{ route('admission') }}" class="text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>Tuyển Sinh</a></li>
                    <li><a href="{{ route('curriculum') }}" class="text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>Chương trình học</a></li>
                    <li><a href="{{ route('parent') }}" class="text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>Phụ huynh</a></li>
                </ul>
            </div>
        </div>

        <!-- Mạng xã hội -->
        <div class="d-flex justify-content-center mt-3">
            <a href="#" class="btn btn-sm btn-light rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-sm btn-light rounded-circle me-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="fab fa-youtube"></i></a>
        </div>

        <hr class="my-4 border-light">

        <!-- Bản quyền -->
        <div class="text-center small">
            © 2025 Trường Mầm Non Thiên Ân. All rights reserved.
        </div>
    </div>
</footer>
