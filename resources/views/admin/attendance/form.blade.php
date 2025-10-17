@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    {{-- 🔙 Nút quay về Dashboard --}}
    <div class="mb-3">
        <a href="{{ route($authUser->role . '.dashboard') }}" class="btn btn-secondary">
            ⬅️ Quay về Dashboard
        </a>
    </div>

    <h3>📋 Điểm danh lớp {{ $gradeLabel ?? $classname ?? '' }} - Ngày {{ $date ?? now()->toDateString() }}</h3>

    {{-- 📝 Nút chỉnh sửa ngày hôm qua (nếu có điểm danh hôm qua) --}}
    @if(($attendanceDates ?? collect())->contains($yesterday))
        <a href="{{ route($authUser->role . '.attendances.form', [$classname, $yesterday]) }}"
           class="btn btn-warning btn-sm m-1">
            📝 Chỉnh sửa điểm danh ngày {{ $yesterday }}
        </a>
    @endif

    {{-- 🏫 Chọn lớp (chỉ cho admin/manager) --}}
    @if(in_array($authUser->role, ['admin', 'manager']))
    <form action="{{ route($authUser->role . '.attendances.form') }}" method="get" class="mb-3 d-flex gap-2">
        <select name="classname" class="form-select" style="width:200px">
            <option value="">-- Chọn lớp --</option>
            @foreach(($classGrades ?? []) as $code => $label)
                <option value="{{ $code }}" {{ $classname == $code ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="date" value="{{ $today }}">
        <button type="submit" class="btn btn-primary">Xem</button>
    </form>
    @endif

    {{-- 🔔 Thông báo --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- 🧾 Form điểm danh --}}
    @if(!empty($classname))
    <form action="{{ route($authUser->role . '.attendances.store') }}" method="post">
        @csrf
        <input type="hidden" name="classname" value="{{ $classname }}">
        <input type="hidden" name="date" value="{{ $date ?? now()->toDateString() }}">

        <table class="table table-bordered align-middle">
            <thead>
                <tr class="table-secondary">
                    <th width="5%">#</th>
                    <th>Tên học sinh</th>
                    <th width="20%">Trạng thái</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    @php
                        $record = $attendances->firstWhere('student_id', $student->id);
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->fullname }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <label>
                                    <input type="radio" name="students[{{ $student->id }}][status]" value="present"
                                           {{ ($record && $record->status === 'present') || !$record ? 'checked' : '' }}
                                           {{ !$canEdit ? 'disabled' : '' }}>
                                    Có mặt
                                </label>
                                <label>
                                    <input type="radio" name="students[{{ $student->id }}][status]" value="absent"
                                           {{ $record && $record->status === 'absent' ? 'checked' : '' }}
                                           {{ !$canEdit ? 'disabled' : '' }}>
                                    Vắng
                                </label>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="students[{{ $student->id }}][note]"
                                   class="form-control"
                                   value="{{ $record->note ?? '' }}"
                                   {{ !$canEdit ? 'readonly' : '' }}>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Không có học sinh trong lớp này.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if ($canEdit)
        <div class="text-end">
            <button type="submit" class="btn btn-success">💾 Lưu điểm danh</button>
        </div>
        @endif
    </form>
    @endif

    {{-- 📅 Ngày đã điểm danh --}}
    @if(!empty($attendanceDates) && count($attendanceDates))
    <hr>
    <div>
        <h5>📅 Ngày đã điểm danh:</h5>
        @foreach ($attendanceDates as $d)
            <a href="{{ route($authUser->role . '.attendances.form', [$classname, $d]) }}"
               class="btn btn-outline-secondary btn-sm m-1 {{ $d == $date ? 'active' : '' }}">
                {{ $d }}
            </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
