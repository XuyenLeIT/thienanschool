@if ($authUser->role === 'admin' || ($authUser->role === 'manager' && !in_array($acc->role, ['admin', 'manager'])))
    {{-- Edit --}}
    <a href="{{ route($authUser->role . '.accounts.edit', $acc->id) }}"
       class="btn btn-sm btn-warning me-1" title="Edit">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>

    {{-- Detail --}}
    <a href="{{ route($authUser->role . '.accounts.show', $acc->id) }}"
       class="btn btn-sm btn-info me-1" title="Detail">
        <i class="fa-solid fa-eye"></i>
    </a>

    {{-- Ban / Unban --}}
    @if ($acc->status)
        {{-- Active → Ban --}}
        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                data-bs-target="#banModal" data-userid="{{ $acc->id }}" title="Ban User">
            <i class="fa-solid fa-user-slash"></i>
        </button>
    @else
        {{-- Inactive → Unban --}}
        <form action="{{ route($authUser->role . '.accounts.ban', $acc->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-success me-1" title="Unban User">
                <i class="fa-solid fa-user-slash"></i>
            </button>
        </form>
    @endif
@else
    <span class="text-muted">-</span>
@endif
