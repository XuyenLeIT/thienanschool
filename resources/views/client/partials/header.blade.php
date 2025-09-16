<!-- Optional custom CSS -->
<style>
.navbar-nav .nav-link {
    position: relative;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #007bff;
    left: 0;
    bottom: 0;
    transition: width 0.3s ease;
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    width: 100%;
}

.navbar-toggler {
    border-radius: 50%;
    background-color: rgba(0,0,0,0.1);
    padding: 0.25rem 0.5rem;
}

.navbar-toggler:hover {
    background-color: rgba(0,0,0,0.2);
}
</style>

<nav class="navbar navbar-expand-lg shadow-sm py-3" style="background: linear-gradient(90deg, #ffecd2, #fcb69f);">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
      <i class="fa-solid fa-rainbow me-2 text-primary"></i> Mầm Non Thiên Ân
    </a>

    <!-- Toggle button -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
    </button>

    <!-- Nav links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('curriculum*') ? 'active fw-bold' : '' }}" href="{{ url('/curriculum') }}">Chương trình học</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admission*') ? 'active fw-bold' : '' }}" href="{{ url('/admission') }}">Tuyển sinh</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('parent*') ? 'active fw-bold' : '' }}" href="{{ url('/parent') }}">Phụ Huynh</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact*') ? 'active fw-bold' : '' }}" href="{{ url('/contact') }}">Liên hệ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

