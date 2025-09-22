@extends('admin.layout.app')
@section('title', 'Điểm danh lớp ' . $classname)

@section('content')
<div class="container">
    <h3 class="mb-3">Điểm danh lớp {{ $classname }} ({{ $today }})</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="classname" value="{{ $classname }}">
        <input type="hidden" name="date" value="{{ $today }}">

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Học sinh</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $i => $student)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $student->fullname }}</td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" 
                                   name="students[{{ $student->id }}][status]" 
                                   value="present" checked>
                            <label class="form-check-label">Có mặt</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" 
                                   name="students[{{ $student->id }}][status]" 
                                   value="absent">
                            <label class="form-check-label">Vắng</label>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control" 
                               name="students[{{ $student->id }}][note]" 
                               placeholder="Ghi chú...">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success px-4">Lưu điểm danh</button>
    </form>
</div>
@endsection
