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
                <img src="https://i.pravatar.cc/40" alt="profile" class="rounded-circle me-2" width="40"
                    height="40">
                <span>Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="nav-link"><i class="fas fa-users me-2"></i>Logout</a>
                </li>

            </ul>
        </div>
    </header>

    <!-- Sidebar + Main -->
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="p-3">
            <h5 class="text-white mb-4">📋 Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i
                            class="fas fa-home me-2"></i>Dashboard</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.carausel.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Carausel</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.special_features.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Specials</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.galleries.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Galleries</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.activities.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Activities</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.programs.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Program</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.education.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Education</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.daily_schedules.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Daily Schedules</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.promotions.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Promotions</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.menus.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Menus</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.parent_notices.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Parent</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.tuition.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Học phí</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.registrations.index') }}" class="nav-link"><i
                            class="fas fa-users me-2"></i>Danh Sách Liên hê</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-child me-2"></i>Học
                        sinh</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i
                            class="fas fa-book-open me-2"></i>Chương
                        trình</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i
                            class="fas fa-utensils me-2"></i>Thực
                        đơn</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i
                            class="fas fa-bullhorn me-2"></i>Thông
                        báo</a></li>
            </ul>
        </nav>

        <!-- Main content -->
        <main id="main" class="p-4 w-100">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main").classList.toggle("full");
        });
    </script>
    {{-- Scripts riêng từng trang --}}
    @yield('scripts')
</body>

</html>
