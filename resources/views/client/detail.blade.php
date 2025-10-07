@extends('client.layout.app')

@section('title', 'blog - Trường Mầm Non Thiên Ân')
<style>
        /* =================== Herro =================== */
    .hero-text-wrapper {
        text-align: center;
        position: relative;
        z-index: 2;
        max-width: 700px;
        margin: 0 auto;
        padding: 15px 20px;
        background: rgba(0, 0, 0, 0.45);
        /* nền mờ giúp chữ nổi bật */
        border-radius: 0.5rem;
        /* bo tròn nhẹ */
        color: #fff;
        /* chữ trắng */
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
            background: rgba(0, 0, 0, 0.35);
            /* nền mờ nhẹ hơn trên mobile */
        }

        .hero-text-wrapper p {
            display: none;
            /* ẩn description trên mobile */
        }

        .hero-text-wrapper h1 {
            font-size: 1.8rem;
            /* co nhỏ title */
        }
    }
    /* Lắc nhẹ vô hạn */
    @keyframes wiggle {

        0%,
        100% {
            transform: rotate(-1deg);
        }

        50% {
            transform: rotate(1deg);
        }
    }

    /* Nhịp tim (pulse) vô hạn */
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    /* Glow viền vô hạn */
    @keyframes glow {
        0% {
            box-shadow: 0 0 5px #ff6f61;
        }

        50% {
            box-shadow: 0 0 20px #ff6f61;
        }

        100% {
            box-shadow: 0 0 5px #ff6f61;
        }
    }

    /* Áp dụng cho banner */
    .animate-banner {
        animation: pulse 3s infinite ease-in-out, wiggle 1s infinite ease-in-out;
        transition: transform 0.3s ease;
    }

    .animate-banner:hover {
        animation: glow 2s infinite ease-in-out, pulse 1.5s infinite;
        transform: scale(1.07);
    }
</style>
@section('content')
    {{-- Hero --}}
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
    <!-- Hero -->
    {{-- <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center"
        style="background: url('https://picsum.photos/1600/500?parents') no-repeat center center; 
           background-size: cover; min-height: 40vh; position: relative;">
        <div style="position:absolute; inset:0; background: rgba(0,0,0,0.4);"></div>
        <div style="position: relative; z-index:2;">
            <h1 data-aos="fade-up">Góc dành cho Phụ huynh</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">
                Kết nối chặt chẽ giữa nhà trường và gia đình 💕
            </p>
        </div>
    </section> --}}
    <section id="activity-detail" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card shadow-sm border-0 rounded-3">

                        {{-- Hình ảnh đại diện --}}
                        @if ($activity->image)
                            <img src="{{ asset($activity->image) }}" class="card-img-top rounded-top-3"
                                alt="{{ $activity->title }}">
                        @endif

                        <div class="card-body p-4">
                            {{-- Tiêu đề --}}
                            <h2 class="card-title fw-bold mb-3">
                                {{ $activity->title }}
                            </h2>

                            {{-- Ngày tạo & loại --}}
                            <div class="d-flex justify-content-between text-muted small mb-4">
                                <span><i class="fa-regular fa-calendar"></i>
                                    {{ $activity->created_at->format('d/m/Y') }}</span>
                                <span>
                                    <i class="fa-solid fa-tag"></i>
                                    @if ($activity->type == 1)
                                        Học tập
                                    @elseif($activity->type == 2)
                                        Vui chơi
                                    @else
                                        Tin tức & Sự kiện
                                    @endif
                                </span>
                            </div>

                            {{-- Mô tả ngắn --}}
                            @if ($activity->shortdes)
                                <p class="lead">{{ $activity->shortdes }}</p>
                            @endif

                            {{-- Nội dung chi tiết --}}
                            <div class="content mt-4">
                                {!! $activity->description !!}
                            </div>

                            {{-- Nút quay lại --}}
                            <div class="mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Bài viết khác --}}
                    {{-- Bài viết khác --}}
                    <div id="other-articles" class="mt-5">
                        <h4 class="fw-bold mb-3">Bài viết khác</h4>
                        <div class="row g-4">
                            @foreach ($otherActivities as $item)
                                <div class="col-md-4">
                                    <div class="card shadow-sm h-100">
                                        <img src="{{ asset($item->image) }}" class="card-img-top"
                                            style="height:180px; object-fit:cover;" alt="{{ $item->title }}">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title">{{ $item->title }}</h6>
                                            <p class="text-muted small mb-2">
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </p>
                                            <a href="{{ $item->slug ? route('activities.detail', $item->slug) : '#' }}"
                                                class="mt-auto btn btn-sm btn-outline-primary {{ !$item->slug ? 'disabled' : '' }}">
                                                Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $otherActivities->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>


                </div>
                {{-- Cột banner quảng cáo --}}
                <div class="col-lg-3">
                    <div class="sticky-top" style="top: 20px;">
                        @if ($promotion)
                            <div class="card mb-4 shadow-sm animate-banner">
                                <img src="{{ asset($promotion->image) }}" class="card-img-top"
                                    alt="{{ $promotion->title }}">

                                <div class="card-body text-center">
                                    <h6 class="fw-bold text-primary">{{ $promotion->title }}</h6>
                                    <p class="small mb-2">{!! $promotion->description !!}</p>
                                    <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#registrationModal">
                                        Đăng Ký Ngay
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-muted text-center">Chưa có khuyến mãi</p>
                        @endif
                    </div>
                </div>


            </div>


        </div>
    </section>
    {{-- Include modal --}}
    @include('client.partials.registration_modal')
    @include('client.partials.contact_icon')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Nếu URL có tham số page => nghĩa là đang ở trang phân trang
            if (window.location.search.includes('page=')) {
                const section = document.getElementById('other-articles');
                if (section) {
                    // Cuộn xuống vị trí của phần "Bài viết khác"
                    section.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    </script>

@endsection
