@extends('client.layout.app')

@section('title', 'blog - Trường Mầm Non Thiên Ân')
<style>
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
    <!-- Hero -->
    <section class="hero d-flex flex-column justify-content-center align-items-center text-white text-center"
        style="background: url('https://picsum.photos/1600/500?parents') no-repeat center center; 
           background-size: cover; min-height: 40vh; position: relative;">
        <div style="position:absolute; inset:0; background: rgba(0,0,0,0.4);"></div>
        <div style="position: relative; z-index:2;">
            <h1 data-aos="fade-up">Góc dành cho Phụ huynh</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">
                Kết nối chặt chẽ giữa nhà trường và gia đình 💕
            </p>
        </div>
    </section>
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
                    <div class="mt-5">
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
                    </div>
                </div>
                {{-- Cột banner quảng cáo --}}
                <div class="col-lg-3">
                    <div class="sticky-top" style="top: 80px;">

                        {{-- Banner 1: Khuyến mãi balo --}}
                        <div class="card mb-4 shadow-sm animate-banner" data-aos="fade-left">
                            <img src="https://picsum.photos/300/400?ad1" class="card-img-top" alt="Khuyến mãi balo">
                            <div class="card-body text-center">
                                <h6 class="fw-bold text-primary">🎒 Khuyến mãi BALO</h6>
                                <p class="small mb-2">
                                    Tặng balo xinh xắn cho <b>5 bé đầu tiên</b> đăng ký nhập học tháng này.
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Đăng ký ngay</a>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>
    </section>


@endsection
