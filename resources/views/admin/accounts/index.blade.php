@extends('admin.layout.app')
@section('title', 'Danh sách Account')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Accounts</h2>
        <a href="{{ route($authUser->role . '.accounts.create') }}" class="btn btn-success">
            <i class="fa-solid fa-user-plus"></i> Thêm Account
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
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
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accounts as $index => $acc)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                {{-- Avatar --}}
                                <td>
                                    @if ($acc->avatar)
                                        <img src="{{ asset($acc->avatar) }}" alt="Avatar"
                                             class="rounded-circle" width="40" height="40">
                                    @else
                                        <i class="fa-solid fa-user fa-2x text-secondary"></i>
                                    @endif
                                </td>

                                <td>{{ $acc->fullname }}</td>
                                <td>{{ $acc->phone ?? '-' }}</td>

                                {{-- Role --}}
                                <td><span class="badge bg-primary text-uppercase">{{ $acc->role }}</span></td>

                                {{-- Admin Approve --}}
                                <td>
                                    <span class="badge {{ $acc->admin_approve ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $acc->admin_approve ? 'Yes' : 'No' }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span class="badge {{ $acc->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $acc->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>{{ $acc->startdate?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $acc->classname ?? '-' }}</td>

                                {{-- Action --}}
                                <td>
                                    @include('admin.accounts.actions', [
                                        'acc' => $acc,
                                        'authUser' => $authUser
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    Không có account nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ban User --}}
@include('admin.accounts.banModal')

@endsection

@section('scripts')
<script>
    const banModal = document.getElementById('banModal');
    banModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const userId = button.dataset.userid;
        const rolePrefix = "{{ $authUser->role }}"; // admin hoặc manager
        document.getElementById('banForm').action = `/${rolePrefix}/accounts/ban/${userId}`;
    });

    document.querySelectorAll('.reason-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById('otherReasonDiv').style.display =
                this.value === 'Khác' ? 'block' : 'none';
        });
    });
</script>
@endsection
