@extends('client.layout.app')

@section('title', 'Trang chủ | Trường Mầm Non Thiên Ân')
@section('meta_description',
    'Trang chủ Trường Mầm Non Thiên Ân - môi trường học tập an toàn, sáng tạo và thân thiện cho
    trẻ nhỏ.')
@section('meta_keywords', 'mầm non, giáo dục trẻ em, Thiên Ân School, chương trình học, hoạt động trẻ em')
@section('og_title', 'Trang chủ Trường Mầm Non Thiên Ân')
@section('og_description', 'Trải nghiệm môi trường học tập an toàn và sáng tạo tại Trường Mầm Non Thiên Ân.')
@section('og_image', $carausels->first()?->image ?? asset('images/share-image.jpg'))

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')

    {{-- Hero Carousel --}}
    @include('client.partials.hero', ['carausels' => $carausels])

    {{-- Features Section --}}
    <section class="py-2 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Stack -->
                <div class="col-md-6 d-none d-md-block">
                    <div class="img-stack">
                        @foreach ($features as $feature)
                            @foreach ($feature->images as $img)
                                <img src="{{ asset($img->image) }}" alt="Feature image">
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <!-- Feature Content -->
                <div
                    class="col-md-6 d-flex flex-column align-items-center align-items-md-start text-center text-md-start feature-content">
                    <h2 class="mb-3 fw-bold">{{ $features[0]->title }}</h2>
                    <p class="mb-4 text-muted">{{ $features[0]->description }}</p>

                    <div class="row g-4 justify-content-center justify-content-md-start w-100 feature-row">
                        @foreach ($features as $feature)
                            @foreach ($feature->subdes as $sub)
                                <div
                                    class="col-12 col-md-6 d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-center justify-content-md-start text-center text-md-start feature-item">
                                    <i
                                        class="{{ $sub->icon_class ?? 'fa-solid fa-star' }} fs-4 text-warning me-md-3 mb-2 mb-md-0"></i>
                                    <div class="feature-text">
                                        <h6 class="fw-bold mb-1">{{ $sub->title }}</h6>
                                        <p class="mb-0 text-muted small">{{ $sub->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="programs" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="section-title fw-bold mb-5" data-aos="fade-up">
                Chương trình học
            </h2>

            <div class="row gy-4 gx-md-4 justify-content-center">
                @foreach ($programs as $key => $program)
                    <div class="gy-3 col-sm-6 col-md-4" data-aos="zoom-in" data-aos-delay="{{ $key * 150 }}">
                        <div class="program-card p-4 gy-2 bg-white rounded-4 shadow-sm">
                            <i class="{{ $program->icon }} display-5 text-warning mb-3"></i>
                            <h5 class="fw-semibold mb-2">{{ $program->title }}</h5>
                            <p class="text-muted mb-0">{{ $program->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    {{-- Activities Slider --}}
    <div class="activities-slider p-2 p-md-4 p-lg-5"
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
                    <div class="col-lg-6 mb-4 mb-lg-0 text-lg-start text-center">
                        <h3 class="display-6 fw-bold mb-3 mt-3">{{ $gallery->title }}</h3>
                        <p class="mb-4 text-muted">{{ $gallery->description }}</p>
                    </div>

                    <div class="col-lg-6 position-relative d-flex justify-content-center">
                        @php $images = $gallery->images; @endphp

                        @if ($images->count() > 0)
                            <div class="art-image art-image-main shadow-sm mb-3">
                                <img src="{{ asset($images[0]->image_path) }}" class="img-fluid rounded" alt="Art main">
                            </div>
                        @endif

                        @if ($images->count() > 1)
                            <div class="art-image art-image-top shadow-sm">
                                <img src="{{ asset($images[1]->image_path) }}" class="img-fluid rounded" alt="Art top">
                            </div>
                        @endif

                        @if ($images->count() > 2)
                            <div class="art-image art-image-bottom shadow-sm">
                                <img src="{{ asset($images[2]->image_path) }}" class="img-fluid rounded" alt="Art bottom">
                            </div>
                        @endif

                        @if ($images->count() > 3)
                            <div class="art-image art-image-left shadow-sm">
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
            <div class="trial-card" style="--trial-bg: url('{{ asset($promotion->image) }}');">
                <div class="trial-content">
                    <h2 class="display-6 fw-bold mb-3 text-white">{{ $promotion->title }}</h2>
                    <p class="mb-4 fs-5 text-white">{{ $promotion->description }}</p>
                    <a href="#" class="trial-btn" data-bs-toggle="modal" data-bs-target="#registrationModal">
                        Đăng Ký Ngay
                    </a>
                </div>
                <div class="trial-image">
                    <img src="{{ asset($promotion->image) }}" alt="{{ $promotion->title }}">
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="container py-2">
        <h2 class="section-title m-2 text-center" id="section-title" data-aos="fade-up">
            Tin tức & Sự kiện
        </h2>

        <div class="row g-4 mt-3 justify-content-center">
            @forelse($newsActivities as $key => $news)
                <div class="col-10 col-sm-8 col-md-4" data-aos="fade-up" data-aos-delay="{{ $key * 200 }}">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $news->image ? asset($news->image) : 'https://via.placeholder.com/400x250' }}"
                            class="card-img-top" alt="{{ $news->title }}">
                        <div class="card-body text-center text-md-start">
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
                <p class="text-muted text-center">Chưa có tin tức nào.</p>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $newsActivities->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>



    {{-- Include modal & icons --}}
    @include('client.partials.registration_modal')
    @include('client.partials.contact_icon')

@endsection
