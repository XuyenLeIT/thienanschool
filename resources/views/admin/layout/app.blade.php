<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Thiên Ân')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body { font-family: "Quicksand", sans-serif; overflow-x: hidden; }
        #sidebar { width: 250px; min-height: 100vh; background: #343a40; color: white; transition: all 0.3s ease; }
        #sidebar a { color: white; text-decoration: none; }
        #sidebar .nav-link:hover { background: rgba(255, 255, 255, 0.1); border-radius: 5px; }
        #sidebar.collapsed { margin-left: -250px; }
        #main { transition: margin-left 0.3s ease; }
        #main.full { margin-left: 0; }
        .admin-header { background: #fff; border-bottom: 1px solid #ddd; padding: 10px 20px; }
        .admin-header .logo { font-weight: bold; color: #343a40; }
    </style>
</head>

<body>
@php
    $authUser = session('auth_user');
    $role = $authUser->role ?? null;
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
            @if($authUser && $authUser->avatar)
                <img src="{{ asset($authUser->avatar) }}" alt="profile" class="rounded-circle me-2" width="40" height="40">
            @else
                <i class="fa-solid fa-user-circle fa-2x text-secondary me-2"></i>
            @endif
            <span>
                {{ $authUser->fullname ?? $authUser->email }}
                @if($role) <small class="text-muted">({{ strtoupper($role) }})</small> @endif
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('accounts.profile', $authUser->id ?? 0) }}">
                    <i class="fas fa-user me-2"></i>Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="{{ route('logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
        </ul>
    </div>
</header>

<!-- Sidebar + Main -->
<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="p-3">
        <h5 class="text-white mb-4">Thiên Ân Admin</h5>
        <ul class="nav flex-column">
            @php
                $menus = [];

                if ($role === 'teacher') {
                    $menus[] = ['route' => 'teacher.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'];
                } elseif ($role === 'manager') {
                    $menus = [
                        ['route' => 'manager.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                        ['route' => 'manager.daily_schedules.index', 'icon' => 'fa-calendar-day', 'label' => 'Daily Schedules'],
                        ['route' => 'manager.tuitions.index', 'icon' => 'fa-money-bill', 'label' => 'Học phí'],
                        ['route' => 'manager.registrations.index', 'icon' => 'fa-address-book', 'label' => 'Danh Sách Liên hệ'],
                        ['route' => 'manager.accounts.index', 'icon' => 'fa-users', 'label' => 'Nhân Sự'],
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
                    ];
                }
            @endphp

            @foreach($menus as $menu)
                <li class="nav-item mb-2">
                    <a href="{{ route($menu['route']) }}" class="nav-link">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById("sidebar");
    const main = document.getElementById("main");
    const toggleBtn = document.getElementById("sidebarToggle");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        main.classList.toggle("full");
    });

    const navLinks = sidebar.querySelectorAll(".nav-link");
    navLinks.forEach(link => link.addEventListener("click", () => {
        if (window.innerWidth < 768) {
            sidebar.classList.add("collapsed");
            main.classList.add("full");
        }
    }));

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
