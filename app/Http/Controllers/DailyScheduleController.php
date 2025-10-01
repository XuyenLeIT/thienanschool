<?php

namespace App\Http\Controllers;

use App\Models\DailySchedule;
use Illuminate\Http\Request;

class DailyScheduleController extends Controller
{
 public function index()
    {
         $authUser = session('auth_user');
        $schedules = DailySchedule::orderBy('order')->get();
        return view('admin.daily_schedules.index', compact('schedules','authUser'));
    }

    public function create()
    {
        return view('admin.daily_schedules.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|string|max:50',
            'activity' => 'required|string|max:255',
        ]);

        DailySchedule::create($request->all());

        return redirect()->route('admin.daily_schedules.index')
                         ->with('success', 'Thêm lịch học thành công!');
    }

    public function edit(DailySchedule $dailySchedule)
    {
        return view('admin.daily_schedules.form', compact('dailySchedule'));
    }

    public function update(Request $request, DailySchedule $dailySchedule)
    {
        $request->validate([
            'time' => 'required|string|max:50',
            'activity' => 'required|string|max:255',
        ]);

        $dailySchedule->update($request->all());

        return redirect()->route('admin.daily_schedules.index')
                         ->with('success', 'Cập nhật lịch học thành công!');
    }

    public function destroy(DailySchedule $dailySchedule)
    {
        $dailySchedule->delete();
        return redirect()->route('admin.daily_schedules.index')
                         ->with('success', 'Xóa lịch học thành công!');
    }
    public function reorder(Request $request)
{
    $request->validate([
        'order' => 'required|array',
        'order.*.id' => 'required|exists:daily_schedules,id',
        'order.*.order' => 'required|integer',
    ]);

    foreach ($request->order as $item) {
        DailySchedule::where('id', $item['id'])->update(['order' => $item['order']]);
    }

    return response()->json(['status' => 'success']);
}

}
