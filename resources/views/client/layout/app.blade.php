<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.jpg') }}">
    <title>@yield('title', 'Trường Mầm Non Thiên Ân')</title>
    <meta name="description" content="@yield('meta_description', 'Trường Mầm Non Thiên Ân - môi trường giáo dục mầm non an toàn, thân thiện, sáng tạo cho trẻ nhỏ.')">
    <meta name="keywords" content="@yield('meta_keywords', 'mầm non, trường mầm non, giáo dục trẻ em, Thiên Ân School')">
    <meta name="author" content="Trường Mầm Non Thiên Ân">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Twitter -->
    <meta property="og:title" content="@yield('og_title', 'Trường Mầm Non Thiên Ân')">
    <meta property="og:description" content="@yield('og_description', 'Môi trường học tập an toàn, sáng tạo cho trẻ nhỏ')">
    <meta property="og:image" content="@yield('og_image', asset('images/share-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <!-- Bootstrap 5 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Flickity CSS -->
    <link rel="stylesheet" href="{{ asset('css/flickity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <style>
        body {
            font-family: "Quicksand", sans-serif;
            background-color: #fffafc;
            color: #333;
            overflow-x: hidden;
            /* ngăn tràn ngang */
        }

        .navbar {
            background-color: #ffb6c1;
        }

        .navbar .nav-link {
            font-weight: 600;
            color: #333 !important;
        }

        .navbar .nav-link.active {
            color: #d63384 !important;
        }

        .hero-carousel .carousel-item {
            height: 80vh;
            min-height: 400px;
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .hero-carousel .carousel-item::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 1.2rem;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            padding: 10px;
        }

        .section-title {
            text-align: center;
            margin: 50px 0 30px;
            font-weight: bold;
            color: #444;
        }

        .carousel-inner img {
            filter: brightness(85%);
        }

        .footer {
            background-color: #ffcad4;
            color: #5a2d2d;
            padding: 20px 0;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    @include('client.partials.header')

    {{-- Nội dung riêng từng trang --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('client.partials.footer')

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Flickity JS -->
    <script src="{{ asset('js/flickity.pkgd.min.js') }}"></script>
    {{-- Scripts riêng từng trang --}}
    @yield('scripts')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17721683359"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-17721683359');
    </script>
    <!-- Event snippet for Người liên hệ conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-17721683359/I53aCL3ckL8bEJ_brYJC'});
</script>

</body>

</html>
