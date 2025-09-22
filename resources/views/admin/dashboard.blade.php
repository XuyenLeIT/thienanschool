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
                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:50px;height:50px;">
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
                        <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:50px;height:50px;">
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
                        <div class="bg-warning text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:50px;height:50px;">
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
                        <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:50px;height:50px;">
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
        <a href="{{ route('admin.attendances.create') }}" class="nav-link"><i class="fas fa-bell me-2"></i>Điểm danh hôm
            nay</a>
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
        <!-- Tabs -->
        <div class="card shadow-sm border-0 rounded-3 mt-5">
            <div class="card-header bg-light">
                <ul class="nav nav-tabs card-header-tabs" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff"
                            type="button" role="tab">Nhân viên</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="new-students-tab" data-bs-toggle="tab" data-bs-target="#new-students"
                            type="button" role="tab">Học sinh mới tháng này</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tuition-schedule-tab" data-bs-toggle="tab"
                            data-bs-target="#tuition-schedule" type="button" role="tab">Lịch học phí</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="dashboardTabsContent">
                    <!-- Nhân viên -->
                    {{-- <div class="tab-pane fade show active" id="staff" role="tabpanel">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhân viên</th>
                                    <th>Chức vụ</th>
                                    <th>Ngày vào làm</th>
                                    <th>Trạng thái duyệt</th>
                                    <th>Trạng thái hoạt động</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="staff-tbody">
                                <!-- JS sẽ render data ở đây -->
                            </tbody>
                        </table>
                    </div> --}}


                    <!-- Học sinh mới tháng này -->
                    <div class="tab-pane fade" id="new-students" role="tabpanel">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên học sinh</th>
                                    <th>Lớp</th>
                                    <th>Ngày nhập học</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nguyễn Thảo D</td>
                                    <td>Lớp A1</td>
                                    <td>05/09/2025</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Trần Minh E</td>
                                    <td>Lớp B2</td>
                                    <td>08/09/2025</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Phạm Ngọc F</td>
                                    <td>Lớp C1</td>
                                    <td>10/09/2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Lịch học phí -->
                    <div class="tab-pane fade" id="tuition-schedule" role="tabpanel">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên học sinh</th>
                                    <th>Lớp</th>
                                    <th>Ngày đóng</th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nguyễn Thảo D</td>
                                    <td>Lớp A1</td>
                                    <td>07/09/2025</td>
                                    <td>1,500,000 đ</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Trần Minh E</td>
                                    <td>Lớp B2</td>
                                    <td>09/09/2025</td>
                                    <td>1,500,000 đ</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Phạm Ngọc F</td>
                                    <td>Lớp C1</td>
                                    <td>11/09/2025</td>
                                    <td>1,500,000 đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchStaff();
    });

    function fetchStaff() {
        fetch('/admin/api/accounts')
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('staff-tbody');
                tbody.innerHTML = '';

                const currentUserId = data.auth_user_id;
                const staffRoles = data.staff_roles; // lấy từ controller

                const staff = data.accounts.filter(acc =>
                    staffRoles.includes(acc.role) &&
                    acc.id !== currentUserId
                );

                staff.forEach((acc, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${acc.fullname}</td>
                    <td>${roleToTitle(acc.role)}</td>
                    <td>${formatDate(acc.startdate)}</td>
                    <td>${acc.admin_approve ? '<span class="text-success">Đã duyệt</span>' : '<span class="text-danger">Chưa duyệt</span>'}</td>
                    <td>${acc.status ? '<span class="text-success">Hoạt động</span>' : '<span class="text-danger">Đã chặn</span>'}</td>
                    <td>
                        <a href="/admin/accounts/${acc.id}" class="btn btn-sm btn-primary">Detail / Edit</a>
                    </td>
                `;
                    tbody.appendChild(tr);
                });
            })
            .catch(err => console.error(err));
    }

    // Chuyển role sang tên hiển thị
    function roleToTitle(role) {
        switch (role) {
            case 'manager':
                return 'Quản lý';
            case 'teacher':
                return 'Giáo viên';
            case 'kitchen':
                return 'Nhân viên bếp';
            case 'nanny':
                return 'Hỗ trợ/Trông trẻ';
            default:
                return role;
        }
    }

    // Format ngày dd/mm/yyyy
    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('vi-VN');
    }
</script>
