<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Thiên Ân')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: "Quicksand", sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: white;
            transition: all 0.3s ease;
        }

        #sidebar a {
            color: white;
            text-decoration: none;
        }

        #sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        /* Sidebar collapsed */
        #sidebar.collapsed {
            margin-left: -250px;
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
        }

        .admin-header .logo {
            font-weight: bold;
            color: #343a40;
        }
    </style>
</head>

<body>
    @php
        $authUser = session('auth_user');
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

                {{-- Avatar --}}
                @if ($authUser && $authUser->avatar)
                    <img src="{{ asset($authUser->avatar) }}" alt="profile" class="rounded-circle me-2" width="40"
                        height="40">
                @else
                    <i class="fa-solid fa-user-circle fa-2x text-secondary me-2"></i>
                @endif

                {{-- Fullname + Role --}}
                <span>
                    {{ $authUser->fullname ?? $authUser->email }}
                    @if ($authUser && $authUser->role)
                        <small class="text-muted">({{ strtoupper($authUser->role) }})</small>
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('thienan.accounts.profile', $authUser->id ?? 0) }}">
                        <i class="fas fa-user me-2"></i>Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cog me-2"></i>Cài đặt
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar + Main -->
    <div class="d-flex">
        <!-- Sidebar -->
        @php
            $authUser = session('auth_user');
            $role = $authUser->role ?? null;

            // Role flags
            $isAdmin = $role === 'admin';
            $isManager = $role === 'manager';
            $isTeacher = $role === 'teacher';
        @endphp

        <!-- Sidebar -->
        <nav id="sidebar" class="p-3">
            <h5 class="text-white mb-4">Thiên Ân Admin</h5>
            <ul class="nav flex-column">

                {{-- Dashboard luôn hiện --}}
                <li class="nav-item mb-2">
                    @if ($isTeacher)
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    @elseif($isManager)
                        <a href="{{ route('manager.dashboard') }}" class="nav-link">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    @endif
                </li>

                {{-- Nếu là teacher thì không hiện các menu khác --}}
                @if (!$isTeacher)
                    @if ($isAdmin)
                        {{-- Menu dành cho admin --}}
                        <li class="nav-item mb-2"><a href="{{ route('admin.carausel.index') }}" class="nav-link"><i
                                    class="fas fa-images me-2"></i>Carausel</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.special_features.index') }}"
                                class="nav-link"><i class="fas fa-star me-2"></i>Specials</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.galleries.index') }}" class="nav-link"><i
                                    class="fas fa-photo-video me-2"></i>Galleries</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.activities.index') }}" class="nav-link"><i
                                    class="fas fa-running me-2"></i>Activities</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.programs.index') }}" class="nav-link"><i
                                    class="fas fa-book me-2"></i>Program</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.education.index') }}" class="nav-link"><i
                                    class="fas fa-graduation-cap me-2"></i>Education</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('admin.promotions.index') }}" class="nav-link"><i
                                    class="fas fa-bullhorn me-2"></i>Promotions</a></li>
                    @endif

                    @if ($isManager)
                        {{-- Menu dành cho manager --}}
                        <li class="nav-item mb-2"><a href="{{ route('manager.daily_schedules.index') }}"
                                class="nav-link"><i class="fas fa-calendar-day me-2"></i>Daily Schedules</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('manager.tuition.index') }}" class="nav-link"><i
                                    class="fas fa-money-bill me-2"></i>Học phí</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('manager.registrations.index') }}"
                                class="nav-link"><i class="fas fa-address-book me-2"></i>Danh Sách Liên hệ</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('manager.accounts.index') }}" class="nav-link"><i
                                    class="fas fa-users me-2"></i>Nhân Sự</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('manager.students.index') }}"
                                class="nav-link"><i class="fas fa-users me-2"></i>Student</a></li>
                    @endif
                @endif
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

        // Hàm toggle sidebar
        function toggleSidebar() {
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("full");
        }

        toggleBtn.addEventListener("click", toggleSidebar);

        // Khi click vào nav link trên mobile, sidebar tự đóng
        const navLinks = sidebar.querySelectorAll(".nav-link");
        navLinks.forEach(link => {
            link.addEventListener("click", () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add("collapsed");
                    main.classList.add("full");
                }
            });
        });

        // Load trang: nếu mobile thì mặc định đóng, desktop mở
        function handleResize() {
            if (window.innerWidth < 768) {
                if (!sidebar.classList.contains("collapsed")) {
                    sidebar.classList.add("collapsed");
                    main.classList.add("full");
                }
            } else {
                if (sidebar.classList.contains("collapsed")) {
                    sidebar.classList.remove("collapsed");
                    main.classList.remove("full");
                }
            }
        }

        window.addEventListener("resize", handleResize);
        window.addEventListener("load", handleResize);
    </script>

    @yield('scripts')
</body>

</html>
