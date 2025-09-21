@extends('admin.layout.app')
@section('title', 'Chi tiết nhân viên')

@section('content')
<div class="container py-4">
    {{-- Back button --}}
    <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary mb-4">
        <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row">
                {{-- Avatar --}}
                <div class="col-md-3 text-center mb-3">
                    @if($account->avatar)
                        <img src="{{ asset($account->avatar) }}" alt="Avatar"
                             class="rounded-circle border border-3 border-primary"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <i class="fa-solid fa-user fa-7x text-secondary"></i>
                    @endif
                </div>

                {{-- Info --}}
                <div class="col-md-9">
                    <h3 class="fw-bold mb-3">{{ $account->fullname }}</h3>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Email:</strong> {{ $account->email }}
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong> {{ $account->phone ?? '-' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Role:</strong>
                            <span class="badge bg-primary text-uppercase">{{ $account->role }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            @if($account->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Admin Approve:</strong>
                            @if($account->admin_approve)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Start Date:</strong>
                            {{ $account->startdate ? $account->startdate->format('d/m/Y') : '-' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Manage Class:</strong> {{ $account->manage_class ?? '-' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Lý do bị ban:</strong> {{ $account->reason_ban ?? '-' }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <strong>Note:</strong>
                            <p class="bg-light p-2 rounded">{{ $account->note ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
