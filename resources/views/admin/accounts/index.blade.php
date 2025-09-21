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
                                {{-- Ẩn account đang login --}}
                                @if ($acc->id === $authUser->id)
                                    @continue
                                @endif
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $acc->fullname }}</td>
                                    <td>{{ $acc->phone ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-primary text-uppercase">{{ $acc->role }}</span>
                                    </td>
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
                                    <td>{{ $acc->manage_class ?? '-' }}</td>
                                    <td>
                                        @if ($authUser->role === 'admin' || ($authUser->role === 'manager' && !in_array($acc->role, ['admin', 'manager'])))
                                            <a href="{{ route('admin.accounts.edit', $acc->id) }}"
                                                class="btn btn-sm btn-warning me-1" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <a href="{{ route('admin.accounts.ban', $acc->id) }}"
                                                class="btn btn-sm {{ $acc->status ? 'btn-warning' : 'btn-success' }} me-1"
                                                title="{{ $acc->status ? 'Ban User' : 'Unban User' }}">
                                                <i class="fa-solid fa-user-slash"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted">Không có account nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
