<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function form(Request $request, $classname = null, $date = null)
    {
        $authUser = session('auth_user');
        $role = $authUser->role ?? 'teacher';

        // --- Lấy lớp và ngày ---
        $classname = $classname ?? $request->input('classname');
        $date = $date ?? $request->input('date') ?? now()->toDateString();
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        // Nếu là giáo viên thì chỉ xem lớp của mình
        if ($role === 'teacher') {
            $classname = $authUser->classname;
        }

        // Danh sách lớp
        $classGrades = Account::$classGrades ?? [];

        // Danh sách học sinh và điểm danh
        $students = collect();
        $attendances = collect();

        if (!empty($classname)) {
            $students = Student::where('classname', $classname)
                ->where('status', 2)
                ->orderBy('fullname')
                ->get();

            $attendances = Attendance::where('classname', $classname)
                ->where('date', $date)
                ->get();
        }

        // Danh sách ngày đã điểm danh (chỉ trong tháng hiện tại và không vượt hôm nay)
        $attendanceDates = Attendance::when($classname, function ($q) use ($classname) {
                $q->where('classname', $classname);
            })
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->where('date', '<=', now()->toDateString())
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date');

        // Tên lớp hiển thị
        $gradeLabel = $classGrades[$classname] ?? ($classname ?: 'Chưa chọn lớp');

        // Kiểm tra có cho phép chỉnh sửa không
        $canEdit = ($date === $today) || ($date === $yesterday);

        return view('admin.attendance.form', compact(
            'students',
            'classname',
            'gradeLabel',
            'date',
            'today',
            'yesterday',
            'attendances',
            'attendanceDates',
            'authUser',
            'classGrades',
            'canEdit'
        ));
    }

    public function store(Request $request)
    {
        $authUser = session('auth_user');
        $teacherId = $authUser->id;
        $date = $request->input('date');
        $classname = $request->input('classname');
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        // ❌ Không cho điểm danh ngày tương lai
        if ($date > $today) {
            return back()->with('error', 'Không thể điểm danh cho ngày tương lai.');
        }

        // ❌ Chỉ cho phép lưu điểm danh hôm nay hoặc hôm qua
        if (!in_array($date, [$today, $yesterday])) {
            return back()->with('error', 'Chỉ được chỉnh sửa điểm danh hôm nay hoặc ngày hôm qua.');
        }

        if (!$classname) {
            return back()->with('error', 'Không xác định được lớp để lưu điểm danh.');
        }

        if (!isset($request->students) || empty($request->students)) {
            return back()->with('error', 'Không có dữ liệu học sinh để lưu.');
        }

        foreach ($request->students as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $date,
                    'classname' => $classname,
                ],
                [
                    'teacher_id' => $teacherId,
                    'status' => $data['status'] ?? 'present',
                    'note' => $data['note'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Điểm danh đã được lưu!');
    }
}
