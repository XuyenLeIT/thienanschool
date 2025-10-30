<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Thiên Ân')</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        body {
            font-family: "Quicksand", sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: white;
            transition: all 0.3s ease;
        }

        #sidebar.collapsed {
            margin-left: -250px;
        }

        #sidebar h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        #sidebar .nav-link {
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            transition: 0.3s;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Main content */
        #main {
            transition: margin-left 0.3s ease;
        }

        #main.full {
            margin-left: 0;
        }

        /* Header */
        .admin-header {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-header .logo {
            font-weight: bold;
            color: #343a40;
            font-size: 18px;
        }

        .dropdown-menu {
            font-size: 14px;
        }
    </style>
</head>

<body>
    @php
        $authUser = session('auth_user');
        $role = $authUser->role ?? null;

        $menus = [];

        if ($role === 'teacher') {
            $menus = [['route' => 'teacher.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard']];
        } elseif ($role === 'manager') {
            // ✅ Chỉ hiển thị 3 mục cho manager
            $menus = [
                ['route' => 'manager.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                ['route' => 'manager.registrations.index', 'icon' => 'fa-address-book', 'label' => 'Danh Sách Liên hệ'],
                ['route' => 'manager.menus.index', 'icon' => 'fa-utensils', 'label' => 'Menus'],
                ['route' => 'manager.students.index', 'icon' => 'fa-users', 'label' => 'Student'],
            ];
        } elseif ($role === 'admin') {
            $menus = [
                ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                ['route' => 'admin.carausel.index', 'icon' => 'fa-images', 'label' => 'Carausel'],
                ['route' => 'admin.special_features.index', 'icon' => 'fa-star', 'label' => 'Specials'],
                ['route' => 'admin.galleries.index', 'icon' => 'fa-photo-video', 'label' => 'Galleries'],
                ['route' => 'admin.activities.index', 'icon' => 'fa-running', 'label' => 'Activities'],
                ['route' => 'admin.programs.index', 'icon' => 'fa-book', 'label' => 'Program'],
                ['route' => 'admin.education.index', 'icon' => 'fa-graduation-cap', 'label' => 'Education'],
                ['route' => 'admin.promotions.index', 'icon' => 'fa-bullhorn', 'label' => 'Promotions'],
                ['route' => 'admin.accounts.index', 'icon' => 'fa-users', 'label' => 'Nhân Sự'],
                ['route' => 'admin.parent_notices.index', 'icon' => 'fa-person-breastfeeding', 'label' => 'Phụ Huynh'],
                ['route' => 'admin.students.index', 'icon' => 'fa-users', 'label' => 'Student'],
                ['route' => 'admin.registrations.index', 'icon' => 'fa-address-book', 'label' => 'Danh Sách Liên hệ'],
            ];
        }
    @endphp

    <!-- Header -->
    <header class="admin-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button id="sidebarToggle" class="btn btn-sm btn-outline-secondary me-3">
                <i class="fas fa-bars"></i>
            </button>
            <span class="logo">🌸 Thiên Ân Admin</span>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                id="profileDropdown" data-bs-toggle="dropdown">
                @if ($authUser && $authUser->avatar)
                    <img src="{{ asset($authUser->avatar) }}" alt="profile" class="rounded-circle me-2" width="40"
                        height="40">
                @else
                    <i class="fa-solid fa-user-circle fa-2x text-secondary me-2"></i>
                @endif
                <span>
                    {{ $authUser->fullname ?? $authUser->email }}
                    @if ($role)
                        <small class="text-muted d-block">({{ strtoupper($role) }})</small>
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                    <a class="dropdown-item"
                        href="{{ route($authUser->role . '.accounts.profile', $authUser->id ?? 0) }}">
                        <i class="fas fa-user me-2"></i>Hồ sơ cá nhân
                    </a>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a href="{{ route('logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Đăng
                        xuất</a></li>
            </ul>
        </div>
    </header>

    <!-- Sidebar + Main -->
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="p-3">
            <h5 class="text-white text-center mb-4">Thiên Ân {{ ucfirst($role) }}</h5>
            <ul class="nav flex-column">
                @foreach ($menus as $menu)
                    <li class="nav-item mb-2">
                        <a href="{{ route($menu['route']) }}"
                            class="nav-link {{ request()->routeIs($menu['route']) ? 'active fw-bold' : '' }}">
                            <i class="fas {{ $menu['icon'] }} me-2"></i>{{ $menu['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Main content -->
        <main id="main" class="p-4 w-100">
            @yield('content')
        </main>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById("sidebar");
        const main = document.getElementById("main");
        const toggleBtn = document.getElementById("sidebarToggle");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("full");
        });

        // Tự động ẩn sidebar khi màn hình nhỏ
        function handleResize() {
            if (window.innerWidth < 768) {
                sidebar.classList.add("collapsed");
                main.classList.add("full");
            } else {
                sidebar.classList.remove("collapsed");
                main.classList.remove("full");
            }
        }

        window.addEventListener("resize", handleResize);
        window.addEventListener("load", handleResize);
    </script>

    @yield('scripts')
</body>

</html>
