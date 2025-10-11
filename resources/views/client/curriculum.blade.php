{{-- PROMOTION BANNER --}}
<section class="container py-2" data-aos="fade-up">
    <h2 class="section-title text-center">Khuyến mãi nhập học sớm</h2>
    @if ($promotion)
        <div class="row justify-content-center">
            <div class="col-lg-10 col-12 px-2 mx-auto"> <!-- padding 2 bên + căn giữa -->
                <div class="card shadow-lg rounded banner-card d-flex flex-row flex-wrap">
                    <!-- IMAGE -->
                    <div class="col-md-5 col-12 p-0 w-100 w-md-auto">
                        <img src="{{ asset($promotion->image) }}" class="img-fluid banner-img w-100" alt="{{ $promotion->title }}">
                    </div>
                    <!-- CONTENT -->
                    <div class="col-md-7 col-12 banner-content p-3 w-100 w-md-auto">
                        <h3 class="fw-bold">{{ $promotion->title }}</h3>
                        <p>{{ $promotion->description }}</p>
                        <a href="#" class="btn btn-enroll btn-lg animated-btn mx-auto d-block" 
                           data-bs-toggle="modal" data-bs-target="#registrationModal">
                           Đăng Ký Ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center">Hiện chưa có khuyến mãi nhập học sớm.</p>
    @endif
</section>

<style>
/* ------------------- PROMOTION BANNER ------------------- */
.banner-card {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 1rem;
    overflow: hidden;
}

.banner-card .banner-img {
    width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: var(--btn-radius);
}

.banner-card .banner-content {
    padding: 1.5rem 1rem;
    text-align: left;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: var(--bg-light);
}

.banner-card .btn-enroll {
    background: var(--primary-color) !important;
    color: var(--text-light) !important;
    width: 100%;
    max-width: 220px;
    margin-top: 0.5rem;
}

.banner-card .btn-enroll:hover {
    background: var(--primary-hover) !important;
}

/* ------------------- RESPONSIVE MOBILE ------------------- */
@media (max-width: 767.98px) {
    .banner-card {
        flex-direction: column;
        text-align: center;
        margin: 0 15px; /* padding 2 bên trên mobile */
    }

    .banner-card .banner-content {
        padding: 0.8rem 1rem; /* padding nhỏ hơn trên mobile */
    }

    .banner-card .banner-img {
        height: 200px;
        max-height: 200px;
        border-radius: var(--btn-radius);
    }

    .banner-card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.8rem;
    }

    .banner-card p {
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .banner-card .btn-enroll {
        max-width: 100%;
        margin: 0.5rem auto 0; /* căn giữa button */
    }
}
</style>
