@extends('client.layout.app')

@section('title', 'Trang chủ')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">


@section('content')

    {{-- Hero Carousel --}}
    @include('client.partials.hero', ['carausels' => $carausels])

    {{-- Features Section --}}
    <section class="py-2 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <!-- Img Stack -->
                <div class="col-md-6 mb-4 mb-md-0 img-stack d-none d-md-block">
                    @foreach ($features as $feature)
                        @foreach ($feature->images as $img)
                            <img src="{{ asset($img->image) }}" class="img-fluid rounded shadow mb-2">
                        @endforeach
                    @endforeach
                </div>
                {{-- @dd($features) --}}
                <!-- Content -->
                <div class="col-md-6">
                    <h2 class="mb-3">{{ $features[0]->title }}</h2>
                    <p class="mb-4">{{ $features[0]->description }}</p>

                    <div class="row g-4">
                        @foreach ($features as $feature)
                            @foreach ($feature->subdes as $sub)
                                <div class="col-12 col-md-6 d-flex">
                                    <i class="{{ $sub->icon_class ?? 'fa-solid fa-star' }} me-2 fs-4"></i>
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $sub->title }}</h6>
                                        <p class="mb-0">{{ $sub->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Programs --}}
    <section id="programs" class="bg-light py-2">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Chương trình học</h2>
            <div class="row text-center">
                @foreach ($programs as $key => $program)
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="{{ $key * 200 }}">
                        <i class="{{ $program->icon }} display-4 text-primary"></i>
                        <h5 class="mt-3">{{ $program->title }}</h5>
                        <p>{{ $program->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Activities Slider --}}
    <div class="activities-slider p-5"
        data-flickity='{"cellAlign":"left","contain":true,"wrapAround":true,"autoPlay":2000,"pageDots":true,"prevNextButtons":true,"groupCells":true}'
        style="width:100%;">
        @foreach ($playActivities as $activity)
            <div class="slider-cell p-2">
                <a href="{{ route('activities.detail', $activity->slug) }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        @if ($activity->image)
                            <img src="{{ asset($activity->image) }}" class="card-img-top" alt="{{ $activity->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->title }}</h5>
                            <div class="card-text-activity">
                                {{ $activity->shortdes }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


    {{-- Galleries --}}
    <section class="art-hero pt-3">
        <div class="container">
            @foreach ($galleries as $gallery)
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h1 class="display-5 fw-bold mb-3 mt-3">{{ $gallery->title }}</h1>
                        <p class="mb-4">{{ $gallery->description }}</p>
                    </div>
                    <div class="col-lg-6 position-relative">
                        @php $images = $gallery->images; @endphp

                        @if ($images->count() > 0)
                            <div class="art-image art-image-main shadow-sm mb-3">
                                <img src="{{ asset($images[0]->image_path) }}" class="img-fluid rounded" alt="Art main">
                            </div>
                        @endif

                        @if ($images->count() > 1)
                            <div class="art-image art-image-top shadow-sm"
                                style="top:0; right:0; position:absolute; z-index:2;">
                                <img src="{{ asset($images[1]->image_path) }}" class="img-fluid rounded" alt="Art top">
                            </div>
                        @endif

                        @if ($images->count() > 2)
                            <div class="art-image art-image-bottom shadow-sm"
                                style="bottom:0; right:20px; position:absolute; z-index:1;">
                                <img src="{{ asset($images[2]->image_path) }}" class="img-fluid rounded" alt="Art bottom">
                            </div>
                        @endif

                        @if ($images->count() > 3)
                            <div class="art-image art-image-left shadow-sm"
                                style="bottom:20px; left:0; position:absolute; z-index:2;">
                                <img src="{{ asset($images[3]->image_path) }}" class="img-fluid rounded" alt="Art left">
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </section>
    {{-- Trial Registration Card --}}
<section id="trial-class" class="py-2" data-aos="fade-up">
    <div class="container">
        <div class="trial-card">

            {{-- Text Content --}}
            <div class="trial-content">
                <h2 class="display-5 fw-bold mb-3">{{ $promotion->title }}</h2>
                <p class="mb-4 fs-5">{{ $promotion->description }}</p>

                <a href="#" class="trial-btn" data-bs-toggle="modal"
                   data-bs-target="#registrationModal">
                    Đăng Ký Ngay
                </a>
            </div>

            {{-- Image minh họa --}}
            <div class="trial-image">
                <img src="{{ $promotion->image }}" alt="{{ $promotion->title }}">
            </div>

        </div>
    </div>
</section>

    {{-- News --}}
    <section id="news" class="container py-2">
        <h2 class="section-title" data-aos="fade-up">Tin tức & Sự kiện</h2>
        <div class="row g-4">
            @forelse($newsActivities as $key => $news)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $key * 200 }}">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $news->image ? asset($news->image) : 'https://via.placeholder.com/400x250' }}"
                            class="card-img-top" alt="{{ $news->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($news->shortdes ?? strip_tags($news->description), 100) }}
                            </p>
                            <a href="{{ route('activities.detail', $news->slug) }}"
                                class="tn-btn tn-btn-sm tn-btn-readmore">
                                Xem thêm
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Chưa có tin tức nào.</p>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $newsActivities->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
    {{-- Include modal --}}
    @include('client.partials.registration_modal')
    {{-- Floating Contact Icons --}}

    @include('client.partials.contact_icon')
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.href.includes("page=")) {
            const newsSection = document.getElementById("news");
            if (newsSection) {
                newsSection.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }
    });
</script>
