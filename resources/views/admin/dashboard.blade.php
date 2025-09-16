@extends('admin.layout.app')

@section('title', 'Dashboard - Thiên Ân')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">📊 Dashboard</h2>

    <!-- Row thống kê -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width:50px;height:50px;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">120</h5>
                        <small class="text-muted">Phụ huynh</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center" style="width:50px;height:50px;">
                        <i class="fas fa-child"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">85</h5>
                        <small class="text-muted">Học sinh</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-white rounded-circle d-flex justify-content-center align-items-center" style="width:50px;height:50px;">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">15</h5>
                        <small class="text-muted">Giáo viên</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center" style="width:50px;height:50px;">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">8</h5>
                        <small class="text-muted">Thông báo</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng thông tin gần đây -->
    <div class="card shadow-sm border-0 rounded-3 mt-5">
        <div class="card-header bg-light">
            <h5 class="mb-0">📌 Hoạt động gần đây</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hoạt động</th>
                        <th>Người thực hiện</th>
                        <th>Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Thêm học sinh mới</td>
                        <td>Cô Mai</td>
                        <td>06/09/2025 09:00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cập nhật thực đơn</td>
                        <td>Admin</td>
                        <td>05/09/2025 15:20</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Gửi thông báo cho phụ huynh</td>
                        <td>Thầy Nam</td>
                        <td>05/09/2025 10:45</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Thêm chương trình học mới</td>
                        <td>Admin</td>
                        <td>04/09/2025 14:15</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
