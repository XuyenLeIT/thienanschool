@extends('admin.layout.app')

@section('title', 'Dashboard - Thiên Ân')

@section('content')
    <style>
        .hover-shadow-sm:hover {
            transform: translateY(-2px);
            transition: 0.2s;
        }
    </style>
    <div class="container-fluid">
        @if (in_array($authUser->role, ['admin', 'manager']))
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2 text-primary"></i> Thống kê
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" type="button" id="toggleStats">
                        <i class="fas fa-chevron-down me-1"></i> Hiện
                    </button>
                </div>

                {{-- Thống kê ẩn mặc định --}}
                <div class="card-body d-none" id="statsPanel">
                    {{-- Thống kê tổng số giáo viên, học sinh, nhân sự --}}
                    <div class="row g-3 mb-3">
                        @foreach ([['count' => $teacherCount ?? 0, 'label' => 'Giáo viên', 'icon' => 'fa-chalkboard-teacher', 'bg' => 'bg-primary'], ['count' => $studentCount ?? 0, 'label' => 'Học sinh', 'icon' => 'fa-child', 'bg' => 'bg-success'], ['count' => $staffCount ?? 0, 'label' => 'Nhân sự khác', 'icon' => 'fa-user-tie', 'bg' => 'bg-danger']] as $stat)
                            <div class="col-md-4 col-sm-6">
                                <div class="card border-0 shadow-sm h-100 hover-shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="{{ $stat['bg'] }} text-white rounded-circle d-flex justify-content-center align-items-center"
                                            style="width:48px;height:48px;font-size:1.2rem;">
                                            <i class="fas {{ $stat['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 fw-bold">{{ $stat['count'] }}</h5>
                                            <small class="text-muted">{{ $stat['label'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Thống kê học sinh theo lớp --}}
                    <h6 class="fw-bold text-muted mt-2 mb-2"><i class="fas fa-school me-2"></i> Học sinh theo lớp</h6>
                    <div class="row g-3">
                        @foreach ($classList as $code => $label)
                            <div class="col-md-3 col-sm-6">
                                <div class="card border-0 shadow-sm h-100 hover-shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center"
                                            style="width:48px;height:48px;font-size:1.1rem;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $classStudentCounts[$code] ?? 0 }}</h6>
                                            <small class="text-muted">{{ $code . ' - ' . $label }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif



        {{-- Tiêu đề điểm danh --}}
        <h2 class="mb-4 mt-2">Danh Sách điểm danh - Lớp {{ $classname }}</h2>
        @php
            // Lấy giờ hiện tại theo định dạng 24h
            $currentTime = now()->format('H:i');
            $canAttend = $currentTime >= '08:00';
        @endphp

        @if (in_array($authUser->role, ['teacher', 'manager']))
            <a href="{{ $canAttend ? route($authUser->role.'.attendances.form', $authUser->classname) : '#' }}"
                class="btn btn-primary mt-2 mb-2 {{ $canAttend ? '' : 'disabled' }}"
                {{ $canAttend ? '' : 'aria-disabled=true tabindex=-1' }}>
                <i class="fa-solid fa-clipboard-user me-2"></i>
                Điểm danh hôm nay
            </a>

            @unless ($canAttend)
                <p class="text-muted small mt-1">Nút sẽ được kích hoạt sau 8:00 sáng.</p>
            @endunless
        @endif


        {{-- Bộ lọc --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route($authUser->role . '.dashboard') }}" class="row g-3 align-items-end">

                    {{-- Bộ lọc ngày --}}
                    <div class="col-md-3">
                        <label for="date" class="form-label fw-semibold">
                            <i class="fas fa-calendar-day me-1"></i> Ngày
                        </label>
                        <div class="input-group">
                            <input type="date" id="date" name="date"
                                value="{{ $selectedDate ?? now()->toDateString() }}" class="form-control"
                                max="{{ now()->toDateString() }}">
                        </div>
                    </div>

                    {{-- Bộ lọc trạng thái --}}
                    <div class="col-md-3">
                        <label for="status_filter" class="form-label fw-semibold">
                            <i class="fas fa-filter me-1"></i> Trạng thái
                        </label>
                        <select id="status_filter" name="status_filter" class="form-select">
                            <option value="all" {{ ($statusFilter ?? 'all') == 'all' ? 'selected' : '' }}>Tất cả
                            </option>
                            <option value="present" {{ ($statusFilter ?? '') == 'present' ? 'selected' : '' }}>Chỉ có mặt
                            </option>
                            <option value="absent" {{ ($statusFilter ?? '') == 'absent' ? 'selected' : '' }}>Chỉ vắng
                            </option>
                        </select>
                    </div>

                    {{-- Bộ lọc lớp (chỉ cho admin/manager) --}}
                    @if (in_array($authUser->role, ['admin', 'manager']))
                        <div class="col-md-3">
                            <label for="classname" class="form-label fw-semibold">
                                <i class="fas fa-school me-1"></i> Lớp
                            </label>
                            <select id="classname" name="classname" class="form-select">
                                @foreach ($classList as $code => $label)
                                    <option value="{{ $code }}"
                                        {{ ($classname ?? '') == $code ? 'selected' : '' }}>
                                        {{ $code . ' - ' . $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Nút submit --}}
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-search me-1"></i> Áp dụng
                        </button>

                        <a href="{{ route($authUser->role . '.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Thống kê tổng số có mặt/vắng --}}
        @if (isset($students))
            @php
                $presentCount = $attendances->where('status', 'present')->count();
                $absentCount = $attendances->where('status', 'absent')->count();
            @endphp
            <div class="mt-3 mb-3 d-flex flex-wrap gap-2">
                <span class="badge attendance-badge bg-success"><i class="fas fa-user-check me-1"></i> Có mặt:
                    {{ $presentCount }}</span>
                <span class="badge attendance-badge bg-danger"><i class="fas fa-user-times me-1"></i> Vắng:
                    {{ $absentCount }}</span>
            </div>
        @endif

        {{-- Danh sách học sinh --}}
        @if (isset($students))
            <h5 class="mt-4">📅 Điểm danh ngày: {{ $selectedDate }}</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Học sinh</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $i => $student)
                            @php
                                $att = $attendances->firstWhere('student_id', $student->id);
                                $status = $att->status ?? '-';
                                $note = $att->note ?? '';
                                if (isset($statusFilter) && $statusFilter != 'all' && $status != $statusFilter) {
                                    continue;
                                }
                            @endphp
                            <tr @if ($status == 'absent') class="table-danger" @endif>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>
                                    @if ($status == 'present')
                                        <span class="badge bg-success"><i class="fas fa-user-check me-1"></i> Có mặt</span>
                                    @elseif($status == 'absent')
                                        <span class="badge bg-danger"><i class="fas fa-user-times me-1"></i> Vắng</span>
                                    @else
                                        <span class="badge bg-secondary">Chưa điểm danh</span>
                                    @endif
                                </td>
                                <td>{{ $note }}</td>
                                <td class="text-center"> {{-- Nút xem chi tiết --}} <button type="button"
                                        class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $student->id }}"> <i class="fas fa-eye"></i>
                                    </button> {{-- Nút thống kê khoảng thời gian --}} <button type="button" class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal" data-bs-target="#statsModal{{ $student->id }}"> <i
                                            class="fas fa-chart-bar"></i> </button> {{-- Modal chi tiết học sinh --}}
                                    @include('admin.partials.student_detail_modal', [
                                        'student' => $student,
                                        'selectedDate' => $selectedDate,
                                    ]) {{-- Modal thống kê khoảng thời gian --}} @include('admin.partials.student_stats_modal', [
                                        'student' => $student,
                                        'classname' => $classname,
                                    ]) </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        .attendance-badge {
            font-size: 1.1rem;
            font-weight: 600;
            padding: 0.5rem 0.8rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width:576px) {
            .d-flex.flex-wrap.align-items-center.gap-3 {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleStats');
            const statsPanel = document.getElementById('statsPanel');
            let isVisible = false; // mặc định ẩn

            toggleBtn.addEventListener('click', () => {
                if (isVisible) {
                    // Ẩn
                    $(statsPanel).slideUp(() => statsPanel.classList.add('d-none'));
                    toggleBtn.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Hiện';
                } else {
                    // Hiện
                    statsPanel.classList.remove('d-none');
                    $(statsPanel).hide().slideDown();
                    toggleBtn.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Ẩn';
                }
                isVisible = !isVisible;
            });
            document.querySelectorAll('.stats-modal').forEach(modalEl => {
                const studentId = modalEl.dataset.studentId;
                const fromInput = modalEl.querySelector('input[name="from_date"]');
                const toInput = modalEl.querySelector('input[name="to_date"]');
                const presentBadge = modalEl.querySelector('#presentBadge' + studentId);
                const absentBadge = modalEl.querySelector('#absentBadge' + studentId);
                const tableBody = modalEl.querySelector('#attendanceTable' + studentId);

                const updateStats = () => {
                    axios.get(`student/${studentId}/stats`, {
                            params: {
                                from: fromInput.value,
                                to: toInput.value,
                                classname: modalEl.dataset.classname
                            }
                        })
                        .then(res => {
                            const data = res.data;
                            console.log("Stats data:", data);

                            // Cập nhật badge tổng số ngày
                            presentBadge.textContent = `Có mặt: ${data.presentDays}`;
                            absentBadge.textContent = `Vắng: ${data.absentDays}`;

                            // Xoá dữ liệu cũ của bảng
                            tableBody.innerHTML = '';

                            // Duyệt qua các record để render bảng
                            if (data.records && data.records.length > 0) {
                                data.records.forEach(item => {
                                    const tr = document.createElement('tr');

                                    // Nền hồng nếu vắng
                                    if (item.status === 'absent') {
                                        tr.style.backgroundColor = '#f8d7da';
                                    }

                                    tr.innerHTML = `
                            <td>${item.date}</td>
                            <td>
                                ${item.status === 'present'
                                    ? '<span class="badge bg-success">Có mặt</span>'
                                    : '<span class="badge bg-danger">Vắng</span>'}
                            </td>
                            <td>${item.note ?? ''}</td>
                        `;
                                    tableBody.appendChild(tr);
                                });
                            } else {
                                // Nếu không có dữ liệu
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                        <td colspan="3" class="text-center text-muted">
                            Không có dữ liệu trong khoảng thời gian đã chọn.
                        </td>`;
                                tableBody.appendChild(tr);
                            }
                        })
                        .catch(err => {
                            console.error("Lỗi khi lấy dữ liệu thống kê:", err);
                            tableBody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center text-danger">
                            Không thể tải dữ liệu.
                        </td>
                    </tr>`;
                        });
                };

                // Sự kiện cập nhật khi nhấn nút Lọc hoặc khi modal mở
                modalEl.querySelector('.btn-stats-update').addEventListener('click', updateStats);
                modalEl.addEventListener('shown.bs.modal', updateStats);
            });
        });
    </script>

@endsection
