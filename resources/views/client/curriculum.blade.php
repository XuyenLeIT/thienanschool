@extends('client.layout.app')

@section('title', 'Chương trình học - Trường Mầm Non Thiên Ân')

@section('content')
    <style>
        /* ------------------- Hero ------------------- */
    .hero-text-wrapper {
    text-align: center;
    position: relative;
    z-index: 2;
    max-width: 700px;
    margin: 0 auto;
    padding: 15px 20px;
    background: rgba(0, 0, 0, 0.45); /* nền mờ giúp chữ nổi bật */
    border-radius: 0.5rem; /* bo tròn nhẹ */
    color: #fff; /* chữ trắng */
}

.hero-text-wrapper h1 {
    margin-bottom: 10px;
}

.hero-text-wrapper p {
    margin: 0;
}

@media (max-width: 767px) {
    .hero-text-wrapper {
        max-width: 90%;
        padding: 10px 15px;
        background: rgba(0, 0, 0, 0.35); /* nền mờ nhẹ hơn trên mobile */
    }

    .hero-text-wrapper p {
        display: none; /* ẩn description trên mobile */
    }

    .hero-text-wrapper h1 {
        font-size: 1.8rem; /* co nhỏ title */
    }
}


        /* ------------------- General ------------------- */
        .section-title {
            text-align: center;
            font-weight: 700;
            color: #444;
            margin-bottom: 1.5rem;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        /* ------------------- Age Groups ------------------- */
        .age-group-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 1rem;
        }

        .age-group-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        }

        .age-group-card i {
            display: block;
            margin-bottom: 12px;
        }

        @media(max-width:767px) {
            .col-12.col-md-6.col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* ------------------- Education Gallery ------------------- */
        .art-gallery-section {
            --frame-bg: #fff;
            --frame-border: rgba(0, 0, 0, 0.06);
            --soft-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .art-frame {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.9), #fafafa);
            padding: 22px;
            border-radius: 18px;
            border: 1px solid var(--frame-border);
            box-shadow: var(--soft-shadow);
            position: relative;
            overflow: hidden;
        }

        .art-img-main {
            width: 100%;
            height: auto;
            aspect-ratio: 9/7;
            object-fit: cover;
            border-radius: 12px;
            transition: transform .6s ease;
        }

        .art-frame:hover .art-img-main {
            transform: scale(1.02) rotate(-0.5deg);
            filter: saturate(1.02);
        }

        .art-caption {
            margin-top: 12px;
            font-size: .95rem;
            color: #444;
            opacity: .9;
        }

        .art-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .art-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--frame-border);
            background: var(--frame-bg);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        }

        .art-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        }

        .art-card .art-img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            transition: transform .6s ease;
        }

        .art-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            padding: 14px;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, 0.5) 100%);
            opacity: 0;
            transition: opacity .35s ease;
        }

        .art-card:hover .art-overlay {
            opacity: 1;
        }

        .art-overlay-text {
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.45);
        }

        @media(max-width:991px) {
            .art-img-main {
                aspect-ratio: 4/3;
            }

            .art-card .art-img {
                height: 160px;
            }
        }

        @media(max-width:767px) {
            .art-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .art-card .art-img {
                height: 140px;
            }

            .art-frame {
                padding: 14px;
                border-radius: 12px;
            }
        }

        /* ------------------- Daily Schedule ------------------- */
        .daily-schedule-section {
            background: #ffecd2;
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
            padding: 1rem 0.5rem;
        }

        .daily-schedule-section .table-primary {
            background: linear-gradient(90deg, #ffecd2, #fcb69f);
            color: #fff;
            font-weight: 600;
        }

        .daily-schedule-section .table-bordered th,
        .daily-schedule-section .table-bordered td {
            border-color: rgba(252, 182, 159, 0.4);
        }

        .daily-schedule-section table {
            width: 100% !important;
        }

        @media(max-width:767px) {

            .daily-schedule-section table th,
            .daily-schedule-section table td {
                font-size: 0.85rem;
                padding: 0.5rem 0.25rem;
                text-align: center;
            }
        }

        /* ------------------- News ------------------- */
        #news .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        #news .card-title {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        @media(max-width:991px) {
            #news .card-img-top {
                height: 180px;
            }
        }

        @media(max-width:767px) {
            #news .col-12.col-md-6.col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            #news .card-img-top {
                height: 160px;
            }
        }

        /* ------------------- Promotion Banner ------------------- */

        /* Banner promotion - desktop */
        .banner-card {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .banner-img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
        }

        /* Mobile */
        @media (max-width: 767px) {
            .banner-card {
                flex-direction: column;
                /* ảnh trên, text dưới */
            }

            .banner-card .col-md-5,
            .banner-card .col-md-7 {
                width: 100%;
                padding: 0;
                /* loại bỏ padding để ảnh chiếm full */
            }

            .banner-card .col-md-5 {
                max-height: 200px;
                /* giới hạn chiều cao ảnh */
                overflow: hidden;
            }

            .banner-card .banner-img {
                width: 100%;
                height: 200px;
                /* giữ tỉ lệ hợp lý */
                object-fit: cover;
            }

            .banner-card .col-md-7 {
                padding: 1rem 1.5rem;
            }
        }

        .animated-btn {
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }
    </style>

    {{-- ------------------- Hero ------------------- --}}
    @if ($carausel)
        <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center"
            style="background: url('{{ asset($carausel->image) }}') no-repeat center center; background-size: cover; min-height: 50vh; position: relative;">

            <div class="hero-overlay" style="position:absolute; inset:0; background: rgba(0,0,0,0.1);"></div>

            <div style="position: relative; z-index: 2;">
                <div class="hero-text-wrapper" style="max-width: 700px; margin: 0 auto;">
                    <h1 data-aos="fade-up">{{ $carausel->title }}</h1>
                    <p class="lead" data-aos="fade-up" data-aos-delay="200">{{ $carausel->description }}</p>
                </div>
            </div>
        </section>
    @endif

    {{-- ------------------- Age Groups ------------------- --}}
    <section class="container py-2">
        <h2 class="section-title">Các độ tuổi</h2>
        <div class="row g-4">
            @foreach ([['icon' => 'fa-solid fa-star', 'color' => 'text-primary', 'title' => 'Nhà trẻ (0–3 tuổi)', 'desc' => 'Phát triển kỹ năng vận động cơ bản, cảm xúc, giao tiếp đầu đời.'], ['icon' => 'fa-solid fa-paintbrush', 'color' => 'text-success', 'title' => 'Mẫu giáo bé (3–4 tuổi)', 'desc' => 'Tập trung kỹ năng ngôn ngữ, tự lập, hoạt động nhóm đơn giản.'], ['icon' => 'fa-solid fa-book', 'color' => 'text-warning', 'title' => 'Mẫu giáo nhỡ (4–5 tuổi)', 'desc' => 'Khám phá khoa học, toán học cơ bản, phát triển tư duy sáng tạo.'], ['icon' => 'fa-solid fa-futbol', 'color' => 'text-danger', 'title' => 'Mẫu giáo lớn (5–6 tuổi)', 'desc' => 'Chuẩn bị kiến thức, kỹ năng xã hội và tâm lý trước khi vào lớp 1.']] as $group)
                <div class="col-md-6 col-lg-3 col-12">
                    <div class="card age-group-card h-100 text-center">
                        <i class="{{ $group['icon'] }} {{ $group['color'] }} fa-3x"></i>
                        <h5 class="fw-bold mt-2">{{ $group['title'] }}</h5>
                        <p class="text-muted">{{ $group['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ------------------- Education Gallery ------------------- --}}
    <section class="bg-light py-2 art-gallery-section" data-aos="fade-up">
        <div class="container">
            <h2 class="section-title mb-4">Nội dung giáo dục</h2>
            @if ($educationContent)
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <figure class="art-frame">
                            <img src="{{ asset($educationContent->main_image) }}"
                                alt="{{ $educationContent->title ?? 'Education Content' }}" class="art-img art-img-main">
                            @if (!empty($educationContent->caption))
                                <figcaption class="art-caption">{{ $educationContent->caption }}</figcaption>
                            @endif
                        </figure>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        @if ($educationContent->items && $educationContent->items->count())
                            <div class="art-grid">
                                @foreach ($educationContent->items as $item)
                                    <div class="art-card">
                                        <img src="{{ asset($item->image) }}"
                                            alt="{{ $item->overlay_text ?? 'Education item' }}" class="art-img">
                                        @if (!empty($item->overlay_text))
                                            <div class="art-overlay">
                                                <div class="art-overlay-text">{{ $item->overlay_text }}</div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Chưa có nội dung chi tiết.</p>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-center text-muted">Hiện chưa có nội dung giáo dục nào được cập nhật.</p>
            @endif
        </div>
    </section>

    {{-- ------------------- Daily Schedule ------------------- --}}
    <section class="daily-schedule-section py-1 m-4" data-aos="fade-up">
        <div class="container">
            <h2 class="section-title">Lịch học mẫu một ngày</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Thời gian</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->time }}</td>
                                <td>{{ $schedule->activity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Chưa có dữ liệu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ------------------- News ------------------- --}}
    <section id="news" class="container py-1">
        <h2 class="section-title m-2" data-aos="fade-up">Tin tức & Sự kiện</h2>
        <div class="row g-4">
            @forelse($news as $key => $item)
                <div class="col-md-3 col-12" data-aos="fade-up" data-aos-delay="{{ $key * 200 }}">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $item->image ? asset($item->image) : 'https://via.placeholder.com/400x250' }}"
                            class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit($item->shortdes ?? strip_tags($item->description), 100) }}
                            </p>
                            <a href="{{ route('activities.detail', $item->slug) }}" class="btn btn-sm btn-primary">Xem
                                thêm</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Chưa có tin tức nào.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
    </section>

    {{-- ------------------- Promotion Banner ------------------- --}}
    <section class="container py-2" data-aos="fade-up">
        <h2 class="section-title text-center">Khuyến mãi nhập học sớm</h2>
        @if ($promotion)
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg rounded overflow-hidden d-flex flex-row align-items-center banner-card">
                        <div class="col-md-5 p-0">
                            <img src="{{ asset($promotion->image) }}" class="img-fluid banner-img"
                                alt="{{ $promotion->title }}">
                        </div>
                        <div class="col-md-7 p-4 d-flex flex-column justify-content-center bg-light">
                            <h3 class="fw-bold mb-3">{{ $promotion->title }}</h3>
                            <p class="mb-3">{{ $promotion->description }}</p>
                            <a href="#" class="btn btn-danger btn-lg w-auto animated-btn" data-bs-toggle="modal"
                                data-bs-target="#registrationModal">Đăng Ký Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">Hiện chưa có khuyến mãi nhập học sớm.</p>
        @endif
    </section>

    @include('client.partials.registration_modal')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.href.includes("page=")) {
                const newsSection = document.getElementById("news");
                if (newsSection) newsSection.scrollIntoView({
                    behavior: "smooth"
                });
            }
            if (window.innerWidth <= 767) {
                document.querySelectorAll('.banner-img-container').forEach(function(div) {
                    const img = div.querySelector('img');
                    if (img) {
                        div.style.backgroundImage = 'url(' + img.src + ')';
                    }
                });
            }
        });
    </script>
@endsection
