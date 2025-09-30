<div class="modal fade stats-modal"
     id="statsModal{{ $student->id }}"
     data-student-id="{{ $student->id }}"
     data-classname="{{ $classname }}"
     tabindex="-1"
     aria-labelledby="statsModalLabel{{ $student->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            
            {{-- Header --}}
            <div class="modal-header text-white" style="background: linear-gradient(90deg,#ff7e5f,#feb47b);">
                <h5 class="modal-title" id="statsModalLabel{{ $student->id }}">
                    Thống kê điểm danh: {{ $student->fullname }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                {{-- Bộ lọc thời gian --}}
                <div class="row g-2 mb-3">
                    <div class="col-md-5">
                        <input type="date" name="from_date" class="form-control"
                               value="{{ now()->startOfMonth()->toDateString() }}">
                    </div>
                    <div class="col-md-5">
                        <input type="date" name="to_date" class="form-control"
                               value="{{ now()->toDateString() }}">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary w-100 btn-stats-update">
                            <i class="fas fa-filter me-1"></i> Thống kê
                        </button>
                    </div>
                </div>

                {{-- Badge tổng số ngày --}}
                <div class="mb-3">
                    <span class="badge bg-success me-2" id="presentBadge{{ $student->id }}">Có mặt: 0</span>
                    <span class="badge bg-danger" id="absentBadge{{ $student->id }}">Vắng: 0</span>
                </div>

                {{-- Bảng thống kê --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Ngày</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTable{{ $student->id }}">
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Vui lòng chọn thời gian và nhấn "Thống kê" để xem dữ liệu.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
