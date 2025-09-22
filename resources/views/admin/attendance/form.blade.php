@extends('admin.layout.app')
@section('title', 'Điểm danh lớp ' . $classname)

@section('content')
    <div class="container">
        <a href="{{ route('teacher.dashboard') }}" class="btn btn-info">
            <i class="fas fa-home me-2"></i> Back
        </a>
        {{-- <h3 class="mb-3">Điểm danh lớp {{ $classname }} ({{ $date }})</h3> --}}
        <h3 class="mb-3">Điểm danh lớp {{ $gradeLabel }} ({{ $date }})</h3>
        {{-- Button chọn các ngày đã điểm danh --}}
        <div class="mb-3">
            @php
                $today = now()->toDateString();
                $yesterday = now()->subDay()->toDateString();
            @endphp

            {{-- Nút hôm nay để điểm danh mới --}}
            <a href="{{ route('teacher.attendances.form', [$classname, $today]) }}"
                class="btn btn-sm {{ $date == $today ? 'btn-primary' : 'btn-outline-primary' }} me-1 mb-1">
                {{ $today }}
            </a>

            {{-- Nút chỉnh sửa ngày hôm qua --}}
            @if (in_array($yesterday, $attendanceDates->toArray()))
                <a href="{{ route('teacher.attendances.form', [$classname, $yesterday]) }}"
                    class="btn btn-sm {{ $date == $yesterday ? 'btn-primary' : 'btn-outline-primary' }} me-1 mb-1">
                    {{ $yesterday }}
                </a>
            @endif
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('teacher.attendances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="classname" value="{{ $classname }}">
            <input type="hidden" name="date" value="{{ $date }}">

            <table class="table table-bordered table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Học sinh</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $i => $student)
                        @php
                            $presentId = 'present_' . $student->id;
                            $absentId = 'absent_' . $student->id;
                            $studentAttendance = $attendances->firstWhere('student_id', $student->id);
                            $status = $studentAttendance->status ?? 'present';
                            $note = $studentAttendance->note ?? '';
                        @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $student->fullname }}</td>
                            <td class="d-flex flex-column flex-md-row align-items-start">
                                <div class="form-check me-3 mb-2 mb-md-0">
                                    <input type="radio" class="form-check-input" id="{{ $presentId }}"
                                        name="students[{{ $student->id }}][status]" value="present"
                                        {{ $status === 'present' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $presentId }}">Có mặt</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="{{ $absentId }}"
                                        name="students[{{ $student->id }}][status]" value="absent"
                                        {{ $status === 'absent' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $absentId }}">Vắng</label>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control note-input"
                                    name="students[{{ $student->id }}][note]" value="{{ $note }}"
                                    placeholder="Ghi chú...">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success px-4">
                {{ $attendances->isNotEmpty() ? 'Cập nhật' : 'Lưu điểm danh' }}
            </button>
        </form>
    </div>

    <style>
        .note-input {
            min-height: 40px;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .form-check {
                width: 100%;
            }
        }
    </style>
@endsection
