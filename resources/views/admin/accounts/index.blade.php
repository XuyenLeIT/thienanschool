@extends('admin.layout.app')
@section('title', 'Danh sách Account')

@section('content')
    <div class="container-fluid">
        {{-- Header + Add Account --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Accounts</h2>
            <a href="{{ route('admin.accounts.create') }}" class="btn btn-success">
                <i class="fa-solid fa-user-plus"></i> Thêm Account
            </a>
        </div>

        {{-- Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Fullname</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Admin Approve</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Manage Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($accounts as $index => $acc)
                                @if ($acc->id === $authUser->id)
                                    @continue
                                @endif
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    {{-- Avatar --}}
                                    <td>
                                        @if ($acc->avatar)
                                            <img src="{{ asset($acc->avatar) }}" alt="Avatar" class="rounded-circle"
                                                width="40" height="40">
                                        @else
                                            <i class="fa-solid fa-user fa-2x text-secondary"></i>
                                        @endif
                                    </td>

                                    <td>{{ $acc->fullname }}</td>
                                    <td>{{ $acc->phone ?? '-' }}</td>
                                    <td><span class="badge bg-primary text-uppercase">{{ $acc->role }}</span></td>
                                    <td>
                                        @if ($acc->admin_approve)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($acc->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $acc->startdate ? $acc->startdate->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $acc->classname ?? '-' }}</td>
                                    <td>
                                        @if ($authUser->role === 'admin' || ($authUser->role === 'manager' && !in_array($acc->role, ['admin', 'manager'])))
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.accounts.edit', $acc->id) }}"
                                                class="btn btn-sm btn-warning me-1" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin.accounts.show', $acc->id) }}"
                                                class="btn btn-sm btn-info me-1" title="Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            {{-- Ban / Unban --}}
                                            @if ($acc->status)
                                                {{-- User active: show modal để ban --}}
                                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                    data-bs-target="#banModal" data-userid="{{ $acc->id }}"
                                                    title="Ban User">
                                                    <i class="fa-solid fa-user-slash"></i>
                                                </button>
                                            @else
                                                {{-- User inactive: click unban trực tiếp --}}
                                                <form action="{{ route('admin.accounts.ban', $acc->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success me-1"
                                                        title="Unban User">
                                                        <i class="fa-solid fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Không có account nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Ban User --}}
    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="banForm" method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Chọn lý do ban:</p>
                        @php
                            $reasons = [
                                'Vi phạm nội quy',
                                'Lạm quyền',
                                'Không hoàn thành công việc',
                                'Hành vi không phù hợp',
                                'Khác',
                            ];
                        @endphp
                        @foreach ($reasons as $reason)
                            <div class="form-check">
                                <input class="form-check-input reason-radio" type="radio" name="reason"
                                    id="reason{{ $loop->index }}" value="{{ $reason }}">
                                <label class="form-check-label"
                                    for="reason{{ $loop->index }}">{{ $reason }}</label>
                            </div>
                        @endforeach
                        <div class="mt-2" id="otherReasonDiv" style="display:none;">
                            <input type="text" class="form-control" name="other_reason" placeholder="Nhập lý do khác">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Truyền user id vào form action khi show modal
        var banModal = document.getElementById('banModal');
        banModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-userid');
            var form = document.getElementById('banForm');
            form.action = '/admin/accounts/ban/' + userId;
        });

        // Hiển thị input nếu chọn "Khác"
        var radios = document.querySelectorAll('.reason-radio');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                var otherDiv = document.getElementById('otherReasonDiv');
                otherDiv.style.display = this.value === 'Khác' ? 'block' : 'none';
            });
        });
    </script>
@endsection