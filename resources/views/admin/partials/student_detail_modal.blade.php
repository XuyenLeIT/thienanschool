<div class="modal fade" id="detailModal{{ $student->id }}" tabindex="-1"
    aria-labelledby="detailModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white"
                style="background: linear-gradient(90deg,#6a11cb,#2575fc);">
                <h5 class="modal-title" id="detailModalLabel{{ $student->id }}">
                    Chi tiết học sinh
                </h5>
                <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-4 text-center">
                    @if ($student->image)
                        <img src="{{ asset($student->image) }}"
                            class="img-fluid rounded-circle shadow"
                            alt="{{ $student->fullname }}" style="max-width: 150px;">
                    @else
                        <i class="fas fa-user-circle fa-8x text-secondary"></i>
                    @endif
                    <h5 class="mt-2">{{ $student->fullname }}</h5>
                    <span class="badge bg-info">{{ $student->classname }} - {{ $student->grade }}</span>
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Phụ huynh:</th>
                                <td>{{ $student->parent }}</td>
                            </tr>
                            <tr>
                                <th>SĐT phụ huynh:</th>
                                <td>{{ $student->phone }}</td>
                            </tr>
                            <tr>
                                <th>Ngày vào lớp:</th>
                                <td>{{ $student->startdate }}</td>
                            </tr>
                            <tr>
                                <th>Ngày sinh:</th>
                                <td>{{ $student->bod }} ({{ $student->age }} tuổi)</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ:</th>
                                <td>{{ $student->address }}</td>
                            </tr>
                            <tr>
                                <th>Giới tính:</th>
                                <td>
                                    @if ($student->gender == 'male')
                                        <span class="badge bg-primary"><i
                                                class="fas fa-mars me-1"></i>Nam</span>
                                    @else
                                        <span class="badge bg-success"><i
                                                class="fas fa-venus me-1"></i>Nữ</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Ghi chú:</th>
                                <td>{{ $student->note ?: '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
