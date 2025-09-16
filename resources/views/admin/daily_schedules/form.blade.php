@extends('admin.layout.app')

@section('content')
<div class="container">
    <h3>{{ isset($dailySchedule) ? 'Edit' : 'Thêm' }} Lịch học</h3>

    <form action="{{ isset($dailySchedule) ? route('admin.daily_schedules.update', $dailySchedule) : route('admin.daily_schedules.store') }}" method="POST">
        @csrf
        @if(isset($dailySchedule))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Thời gian</label>
            <input type="text" name="time" class="form-control" value="{{ old('time', $dailySchedule->time ?? '') }}" placeholder="07:30 - 08:00">
            @error('time') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Hoạt động</label>
            <input type="text" name="activity" class="form-control" value="{{ old('activity', $dailySchedule->activity ?? '') }}" placeholder="Đón trẻ, trò chuyện sáng">
            @error('activity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-success">{{ isset($dailySchedule) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.daily_schedules.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
