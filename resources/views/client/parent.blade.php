@extends('client.layout.app')

@section('title', 'Phụ huynh - Trường Mầm Non Thiên Ân')
@section('meta_description', 'Cập nhật thông tin cho phụ huynh: thực đơn hàng tuần, thông báo, lời yêu thương, góc tư
    vấn và khuyến mãi nhập học tại Trường Mầm Non Thiên Ân.')
@section('meta_keywords', 'phụ huynh, thực đơn mầm non, thông báo phụ huynh, góc tư vấn, trường mầm non Thiên Ân')
@section('og_title', 'Phụ huynh - Trường Mầm Non Thiên Ân')
@section('og_description', 'Thông tin hữu ích cho phụ huynh: thực đơn, thông báo, lời yêu thương và khuyến mãi nhập học
    sớm.')
@section('og_image', $carausel->image ?? ($promotion->image ?? asset('images/share-image.jpg')))
@section('canonical', url()->current())


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

    /* =================== Banner =================== */
    .banner-container {
        width: 100%;
        max-width: 1200px;
        margin: 2rem auto;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        height: 300px;
    }

    .banner {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        animation: zoom 15s ease-in-out infinite alternate;
        transition: transform 0.5s ease;
    }

    .banner:hover .banner-img {
        transform: scale(1.05);
    }

    .banner-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .banner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        padding: 0 20px;
    }

    .banner-title {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        animation: fadeMove 4s ease-in-out infinite;
    }

    .banner-description {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        animation: fadeMove 4s ease-in-out infinite 1s;
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

    @keyframes zoom {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.02);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeMove {

        0%,
        100% {
            opacity: 0.8;
            transform: translateY(0);
        }

        50% {
            opacity: 1;
            transform: translateY(-10px);
        }
    }

    @keyframes pulseBtn {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .advice .card-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .advice .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tn-btn-readmore {
        background-color: var(--primary-color);
        color: var(--text-dark);
        font-weight: 600;
        border-radius: var(--btn-radius);
        padding: 0.4rem 0.9rem;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        box-shadow: var(--btn-shadow);
        text-align: center;
    }

    .tn-btn-readmore:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        color: var(--text-dark);
    }

    .tn-btn-readmore:focus {
        outline: none;
        box-shadow: 0 0 0 0.25rem rgba(252, 182, 159, 0.3);
    }

    /* =================== Modal =================== */
    .modal-content {
        border-radius: 12px;
    }

    .modal-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .modal-body {
        padding: 1rem 1.5rem;
    }

    .modal-body .form-control,
    .modal-body .form-select,
    .modal-body textarea {
        border-radius: 8px;
    }

    .modal-body .btn-success {
        border-radius: 50px;
        padding: 0.7rem 2rem;
        font-weight: 600;
    }

    /* =================== Responsive =================== */
    @media (max-width: 992px) {

        /* tablet landscape */
        .banner-container {
            height: 220px;
        }

        .banner-title {
            font-size: 1.6rem;
        }

        .banner-description {
            font-size: 1rem;
        }

        .banner-btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        .modal-lg {
            max-width: 800px;
        }
    }

    @media (max-width: 768px) {

        /* tablet portrait */
        .banner-container {
            height: 300px;
        }

        .banner-title {
            font-size: 1.4rem;
        }

        .banner-description {
            font-size: 0.95rem;
        }

        .banner-btn {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .banner-content {
            padding: 0 15px;
            height: 160px;
        }

        .modal-lg {
            max-width: 90%;
        }

        .modal-body {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {

        /* mobile */
        .banner-container {
            height: 180px;
        }

        .banner-title {
            font-size: 1.2rem;
        }

        .banner-description {
            font-size: 0.85rem;
        }

        .banner-btn {
            padding: 0.45rem 0.9rem;
            font-size: 0.8rem;
        }

        .banner-content {
            padding: 0 10px;
        }

        .modal-lg {
            max-width: 95%;
        }

        .modal-body .row.g-3 {
            gap: 0.5rem;
        }

        .modal-body .btn-success {
            width: 100%;
            padding: 0.7rem 0;
        }
    }

    .avatar-wrapper {
        width: 200px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* giữ tỉ lệ, crop vừa phải */
        border-radius: 50%;
    }

    /* Tablet */
    @media (max-width: 768px) {
        .avatar-wrapper {
            width: 150px;
            height: 150px;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .avatar-wrapper {
            width: 120px;
            height: 120px;
        }
    }

    /* =================== Toast =================== */
    #toast-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1080;
    }

    .notice-description {
        display: none;
        /* ẩn mặc định */
        margin-top: 5px;
        font-size: 0.9rem;
        color: #555;
        transition: all 0.3s ease-in-out;
        position: absolute;
        /* để không đẩy layout */
        background: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        z-index: 10;
        width: max-content;
        max-width: 500px;
    }

    .notice-item {
        position: relative;
        /* để notice-description nằm đúng vị trí */
        cursor: pointer;
    }

    .notice-item:hover .notice-description {
        display: block;
    }

    #toast-container {
        position: fixed;
        bottom: calc(20px + env(safe-area-inset-bottom));
        right: 70px;
        left: 20px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        pointer-events: none;
        /* tránh toast che nút bấm khác */
    }

    .toast-custom {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 10px;
        padding: 6px 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 300px;
        margin-top: 10px;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.5s ease;
        pointer-events: auto;
        /* cho phép hover */
    }

    .toast-custom.show {
        opacity: 1;
        transform: translateX(0);
    }

    .toast-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 2px solid #eee;
    }

    .toast-body {
        margin-left: 12px;
        font-size: 0.9rem;
        line-height: 1.3;
    }

    .toast-body strong {
        display: block;
        font-size: 1rem;
    }

    .toast-body small {
        color: #888;
        font-style: italic;
        display: block;
    }

    .toast-body p {
        margin: 4px 0 0;
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

    {{-- Góc tư vấn --}}
    @if (count($advices) > 0)
        <section class="container py-1">
            <h2 class="section-title m-3" data-aos="fade-up">Góc tư vấn</h2>
            <div class="row g-4">
                @foreach ($advices as $index => $advice)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                        <div class="advice card shadow-sm h-100">
                            <img src="{{ $advice['image'] }}" class="card-img-top" alt="{{ $advice['title'] }}" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $advice['title'] }}</h5>
                                <p class="card-text">{{ $advice['shortdes'] }}</p>
                                {{-- <a href="{{ route('activities.detail', $advice->slug) }}" class="btn btn-sm btn-primary">Xem
                                    chi tiết</a> --}}
                                <a href="{{ route('activities.detail', $advice->slug) }}"
                                    class="tn-btn tn-btn-sm tn-btn-readmore">
                                    Xem thêm
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Thực đơn --}}
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Thực đơn hàng tuần</h2>
            @if ($menus->count() > 0)
                <div class="table-responsive" data-aos="zoom-in">
                    <table class="table table-bordered text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Ngày</th>
                                <th>Sáng</th>
                                <th>Trưa</th>
                                <th>Xế</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->day }}</td>
                                    <td>{{ $menu->breakfast }}</td>
                                    <td>{{ $menu->lunch }}</td>
                                    <td>{{ $menu->snack }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info mt-3">
                    <strong>Lưu ý:</strong> Thực đơn có thể thay đổi theo tuần. Phụ huynh vui lòng kiểm tra thường xuyên.
                </div>
            @else
                <p>Chưa có dữ liệu thực đơn.</p>
            @endif
        </div>
    </section>

    {{-- Thông báo --}}
    <section class="container py-5">
        <h2 class="section-title text-center" data-aos="fade-up">Thông báo dành cho phụ huynh</h2>

        @if ($notices->count() > 0)
            <div class="accordion shadow" id="noticesAccordion" data-aos="fade-left">
                @foreach ($notices as $key => $notice)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $key }}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                                aria-controls="collapse{{ $key }}">
                                📢 {{ $notice->title }}
                            </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $key }}" data-bs-parent="#noticesAccordion">
                            <div class="accordion-body">
                                {{ $notice->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">Hiện chưa có thông báo nào.</p>
        @endif
    </section>


    {{-- Lời yêu thương --}}
    <section class="container py-1">
        <h2 class="section-title" data-aos="fade-up">Tình yêu thương của bé</h2>
        <div class="row g-4">
            @forelse($lovemessages as $index => $msg)
                <div class="col-md-3"
                    data-aos="{{ $index % 3 == 0 ? 'fade-right' : ($index % 3 == 1 ? 'fade-up' : 'fade-left') }}">
                    <div
                        class="card h-100 shadow-sm text-center p-3 d-flex flex-column justify-content-center align-items-center">
                        <div class="avatar-wrapper mb-3">
                            <img src="{{ $msg->avatar ? asset($msg->avatar) : 'https://picsum.photos/200' }}"
                                class="rounded-circle avatar-img" alt="{{ $msg->name }}">
                        </div>
                        <h6 class="fw-bold">{{ $msg->name }}</h6>
                        <p class="mb-0">{{ $msg->message }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Chưa có lời yêu thương nào 💕</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Banner promotion --}}
    <section class="banner-container">
        @if ($promotion)
            <div class="banner">
                <img src="{{ asset($promotion->image) }}" alt="{{ $promotion->title }}" class="banner-img">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <h2 class="banner-title">{{ $promotion->title }}</h2>
                    <p class="banner-description">{{ $promotion->description }}</p>
                    <a href="#" class="banner-btn" data-bs-toggle="modal" data-bs-target="#registrationModal">
                        Đăng Ký Ngay
                    </a>
                </div>
            </div>
        @endif
    </section>
        {{-- Toast container --}}
    <div id="toast-container"></div>
    {{-- Include modal --}}
    @include('client.partials.registration_modal')
    @include('client.partials.contact_icon')




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById("toast-container");

            // Ẩn toast khi modal mở
            const modalEl = document.getElementById("registrationModal");
            modalEl.addEventListener("show.bs.modal", () => {
                container.style.display = "none";
            });
            modalEl.addEventListener("hidden.bs.modal", () => {
                container.style.display = "flex";
            });

            let feedbacks = [];
            let index = 0;
            let isShowing = false;
            let hideTimeout; // lưu setTimeout để có thể tạm dừng

            async function loadFeedbacks() {
                try {
                    let res = await fetch("{{ url('/api/feedbacks') }}");
                    feedbacks = await res.json();
                    if (feedbacks.length > 0) {
                        showNextToast();
                    }
                } catch (error) {
                    console.error("Lỗi khi tải feedbacks:", error);
                }
            }

            function showNextToast() {
                if (isShowing || feedbacks.length === 0) return;

                const current = feedbacks[index];
                const toast = document.createElement("div");
                toast.className = "toast-custom";

                toast.innerHTML = `
                <img src="${current.avatar ? current.avatar : 'https://i.pravatar.cc/100'}"
                     class="toast-avatar" alt="${current.name}">
                <div class="toast-body">
                    <strong>${current.name}</strong>
                    <small>${current.parent ?? ''}</small>
                    <p>${current.feedback}</p>
                </div>
            `;

                container.appendChild(toast);
                isShowing = true;

                // Hiện toast
                setTimeout(() => toast.classList.add("show"), 50);

                // Ẩn toast sau 5s
                hideTimeout = setTimeout(hideToast, 5000);

                // Khi hover -> dừng đếm thời gian
                toast.addEventListener("mouseenter", () => {
                    clearTimeout(hideTimeout);
                });

                // Khi rời chuột -> tiếp tục đếm ẩn sau 2s
                toast.addEventListener("mouseleave", () => {
                    hideTimeout = setTimeout(hideToast, 2000);
                });

                function hideToast() {
                    toast.classList.remove("show");
                    toast.addEventListener("transitionend", () => {
                        toast.remove();
                        isShowing = false;
                        index = (index + 1) % feedbacks.length;
                        setTimeout(showNextToast, 1000); // Hiện toast tiếp theo
                    }, {
                        once: true
                    });
                }
            }

            loadFeedbacks();
        });
    </script>




@endsection
