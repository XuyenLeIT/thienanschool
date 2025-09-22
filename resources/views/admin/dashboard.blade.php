@extends('admin.layout.app')

@section('title', 'Dashboard - Thiên Ân')

@section('content')
    <div class="container-fluid">
        @if (in_array($authUser->role, ['admin', 'manager']))
            {{-- Thống kê tổng số giáo viên, học sinh, nhân sự --}}
            <div class="row g-4 mb-4">
                @foreach ([['count' => $teacherCount ?? 0, 'label' => 'Giáo viên', 'icon' => 'fa-chalkboard-teacher', 'bg' => 'bg-primary'], ['count' => $studentCount ?? 0, 'label' => 'Học sinh', 'icon' => 'fa-child', 'bg' => 'bg-success'], ['count' => $staffCount ?? 0, 'label' => 'Nhân sự khác', 'icon' => 'fa-user-tie', 'bg' => 'bg-danger']] as $stat)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="{{ $stat['bg'] }} text-white rounded-circle d-flex justify-content-center align-items-center"
                                    style="width:50px;height:50px;">
                                    <i class="fas {{ $stat['icon'] }}"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ $stat['count'] }}</h5>
                                    <small class="text-muted">{{ $stat['label'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Thống kê học sinh theo lớp --}}
            <div class="row g-4 mt-4">
                @foreach ($classList as $code => $label)
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center"
                                    style="width:50px;height:50px;font-size:1.2rem;">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $classStudentCounts[$code] ?? 0 }}</h5>
                                    <small class="text-muted">{{ $code . '-' . $label }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Tiêu đề điểm danh --}}
        <h2 class="mb-4 mt-2">Danh Sách điểm danh - Lớp {{ $classname }}</h2>
        @if ($authUser->role == 'teacher')
            <a href="{{ route('teacher.attendances.form', $authUser->classname) }}" class="btn btn-primary mt-2 mb-2">
                <i class="fa-solid fa-clipboard-user me-2"></i>Điểm danh hôm nay
            </a>
        @endif

        {{-- Filter form --}}
        <div class="mb-3 d-flex flex-wrap align-items-center gap-3">
            <form method="GET" action="{{ route($authUser->role . '.dashboard') }}" class="d-flex gap-2 mb-0">
                <input type="hidden" name="classname" value="{{ $classname }}">
                <input type="date" name="date" value="{{ $selectedDate ?? now()->toDateString() }}"
                    class="form-control" max="{{ now()->toDateString() }}">
                <button type="submit" class="btn btn-primary d-flex align-items-center"><i
                        class="fas fa-calendar-day me-1"></i> Chọn ngày</button>
            </form>

            <form method="GET" action="{{ route($authUser->role . '.dashboard') }}" class="d-flex gap-2 mb-0">
                <input type="hidden" name="date" value="{{ $selectedDate ?? now()->toDateString() }}">
                <select name="status_filter" class="form-select" style="width:180px;">
                    <option value="all" {{ ($statusFilter ?? 'all') == 'all' ? 'selected' : '' }}>Tất cả</option>
                    <option value="present" {{ ($statusFilter ?? '') == 'present' ? 'selected' : '' }}>Chỉ có mặt</option>
                    <option value="absent" {{ ($statusFilter ?? '') == 'absent' ? 'selected' : '' }}>Chỉ vắng</option>
                </select>
                <button type="submit" class="btn btn-secondary d-flex align-items-center"><i
                        class="fas fa-filter me-1"></i> Lọc</button>
            </form>

            @if (in_array($authUser->role, ['admin', 'manager']))
                <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-2 mb-0">
                    <input type="hidden" name="date" value="{{ $selectedDate ?? now()->toDateString() }}">
                    <input type="hidden" name="status_filter" value="{{ $statusFilter ?? 'all' }}">
                    <select name="classname" class="form-select" style="width:200px;">
                        @foreach ($classList as $code => $label)
                            <option value="{{ $code }}" {{ ($classname ?? '') == $code ? 'selected' : '' }}>
                                {{ $code . '-' . $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-info d-flex align-items-center"><i class="fas fa-school me-1"></i>
                        Chọn lớp</button>
                </form>
            @endif
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.stats-modal').forEach(modalEl => {
                const studentId = modalEl.dataset.studentId;
                const fromInput = modalEl.querySelector('input[name="from_date"]');
                const toInput = modalEl.querySelector('input[name="to_date"]');
                const presentBadge = modalEl.querySelector('#presentBadge' + studentId);
                const absentBadge = modalEl.querySelector('#absentBadge' + studentId);
                const canvas = modalEl.querySelector('#chartStats' + studentId);
                let chartInstance;

                const updateStats = () => {
                    axios.get(`/student/${studentId}/stats`, {
                        params: {
                            from: fromInput.value,
                            to: toInput.value,
                            classname: modalEl.dataset.classname
                        }
                    }).then(res => {
                        const data = res.data;
                        presentBadge.textContent = `Có mặt: ${data.presentDays}`;
                        absentBadge.textContent = `Vắng: ${data.absentDays}`;
                        if (chartInstance) chartInstance.destroy();
                        chartInstance = new Chart(canvas.getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Có mặt', 'Vắng'],
                                datasets: [{
                                    data: [data.presentDays, data.absentDays],
                                    backgroundColor: ['#198754', '#dc3545']
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    });
                }

                modalEl.querySelector('.btn-stats-update').addEventListener('click', updateStats);
                modalEl.addEventListener('shown.bs.modal', updateStats);
            });
        });
    </script>
@endsection
