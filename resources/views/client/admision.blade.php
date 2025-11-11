@extends('client.layout.app')

{{-- SEO --}}
@section('title', 'Tuyển sinh - Trường Mầm Non Thiên Ân')
@section('meta_description', 'Tuyển sinh tại Trường Mầm Non Thiên Ân - thông tin về quy trình, độ tuổi, hồ sơ cần chuẩn bị và học phí cho năm học mới.')
@section('meta_keywords', 'tuyển sinh, mầm non, nhập học, Thiên Ân, giáo dục trẻ em')
@section('og_title', 'Tuyển sinh - Trường Mầm Non Thiên Ân')
@section('og_description', 'Cập nhật thông tin tuyển sinh: quy trình, độ tuổi, hồ sơ và học phí tại Trường Mầm Non Thiên Ân.')
@section('og_image', $carausel->image ?? ($promotion->image ?? asset('images/share-image.jpg')))
@section('canonical', url()->current())


@section('content')
    <style>
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

        .section-title {
            text-align: center;
            margin: 50px 0 30px;
            font-weight: 700;
            color: #444;
        }

        .step-icon {
            font-size: 2rem;
            color: #ff6f61;
        }

        .table th {
            font-weight: 700;
        }

        .sidebar {
            margin-top: 10px;
            position: sticky;
            top: 20px;
        }

        /* Banner */
        .sidebar .bottom-banner {
            background: #ffe6e6;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            /* sticky banner */
            position: sticky;
            top: 20px;
            /* cách top khi scroll */
        }

        /* Banner image */
        .sidebar .bottom-banner img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .banner-btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            animation: pulseBtn 2s infinite;
            text-decoration: none;
        }

        /* Shake animation */
        @keyframes shake {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(2deg);
            }

            50% {
                transform: rotate(-2deg);
            }

            75% {
                transform: rotate(1deg);
            }
        }

        /* Optional: áp dụng animation cho banner */
        .sidebar .bottom-banner {
            animation: shake 1.5s infinite;
        }
    </style>

    <!-- Hero -->
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

    <!-- Main Content with Sidebar -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">

                <!-- Admission Steps -->
                <section data-aos="fade-up">
                    <h2 class="section-title">Quy trình tuyển sinh</h2>
                    <div class="row text-center g-4">
                        <div class="col-md-3" data-aos="zoom-in">
                            <i class="fa-solid fa-file-pen step-icon"></i>
                            <h6 class="mt-2">1. Nộp hồ sơ</h6>
                        </div>
                        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                            <i class="fa-solid fa-people-group step-icon"></i>
                            <h6 class="mt-2">2. Phỏng vấn</h6>
                        </div>
                        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
                            <i class="fa-solid fa-circle-check step-icon"></i>
                            <h6 class="mt-2">3. Xét duyệt</h6>
                        </div>
                        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="600">
                            <i class="fa-solid fa-user-graduate step-icon"></i>
                            <h6 class="mt-2">4. Nhập học</h6>
                        </div>
                    </div>
                </section>

                <!-- Age & Eligibility -->
                <section class="bg-light py-4 rounded mt-5" data-aos="fade-right">
                    <h2 class="section-title">Độ tuổi & đối tượng tuyển sinh</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nhà trẻ: 12 tháng – 36 tháng</li>
                        <li class="list-group-item">Mẫu giáo bé: 3 – 4 tuổi</li>
                        <li class="list-group-item">Mẫu giáo nhỡ: 4 – 5 tuổi</li>
                        <li class="list-group-item">Mẫu giáo lớn: 5 – 6 tuổi</li>
                    </ul>
                </section>

                <!-- Documents -->
                <section class="py-5" data-aos="fade-left">
                    <h2 class="section-title">Hồ sơ cần chuẩn bị</h2>
                    <ul class="list-group shadow">
                        <li class="list-group-item">📌 Đơn xin nhập học (theo mẫu)</li>
                        <li class="list-group-item">📌 Bản sao giấy khai sinh</li>
                        <li class="list-group-item">📌 Giấy khám sức khỏe</li>
                        <li class="list-group-item">📌 Sổ tiêm chủng</li>
                    </ul>
                </section>

                <!-- Tuition -->
                <section class="bg-light py-5 rounded" data-aos="zoom-in">
                    <h2 class="section-title text-center mb-4">Học phí & chính sách</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>Khối lớp</th>
                                    <th>Học phí (VNĐ/tháng)</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tuitions as $tuition)
                                    <tr>
                                        <td>{{ $tuition['grade'] ?? $tuition->grade }}</td>
                                        <td>{{ number_format($tuition['fee'] ?? $tuition->fee) }}</td>
                                        <td>{{ $tuition['note'] ?? $tuition->note }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Chưa có dữ liệu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <!-- Bottom banner -->
                    <div class="bottom-banner text-center p-3 rounded shadow mx-auto"
                        style="background: #ffe0e6; display: inline-block; max-width: 400px; animation: shake 1.5s infinite;">

                        @if ($promotion)
                            <!-- Banner image -->
                            <img src="{{ asset($promotion->image) }}" alt="{{ $promotion->title }}"
                                class="img-fluid rounded mb-2">

                            <!-- Title -->
                            <h5 class="fw-bold mb-1">{{ $promotion->title }}</h5>

                            <!-- Short description -->
                            <p class="mb-2 text-muted">{{ $promotion->description }}</p>

                            <!-- Button -->


                            <a href="#" class="banner-btn" data-bs-toggle="modal" data-bs-target="#registrationModal">
                                Đăng Ký Ngay
                            </a>
                        @endif

                    </div>



                </div>
            </div>
        </div>
        {{-- Include modal --}}
        @include('client.partials.registration_modal')
    </div>
    @include('client.partials.contact_icon')
@endsection
