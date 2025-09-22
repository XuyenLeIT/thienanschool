<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // public function form()
    // {
    //     $teacher = session('auth_user');
    //     $classname = $teacher->classname;

    //     // Lấy danh sách học sinh active
    //     $students = Student::where('classname', $classname)
    //         ->where('status', 1)
    //         ->get();

    //     $today = now()->toDateString();

    //     // Lấy điểm danh đã có của lớp hôm nay
    //     $attendances = Attendance::where('classname', $classname)
    //         ->where('date', $today)
    //         ->get();

    //     return view('admin.attendance.form', compact('students', 'classname', 'today', 'attendances'));
    // }

    // /**
    //  * Lưu hoặc cập nhật điểm danh.
    //  */
    // public function store(Request $request)
    // {
    //     $teacherId = session('auth_user')->id;
    //     $date = $request->date;
    //     $classname = $request->classname;

    //     foreach ($request->students as $studentId => $data) {
    //         Attendance::updateOrCreate(
    //             [
    //                 'student_id' => $studentId,
    //                 'date' => $date,
    //                 'classname' => $classname,
    //             ],
    //             [
    //                 'teacher_id' => $teacherId,
    //                 'status' => $data['status'],
    //                 'note' => $data['note'] ?? null,
    //             ]
    //         );
    //     }

    //     return redirect()->back()->with('success', 'Điểm danh đã được lưu!');
    // }
    public function form($classname, $date = null)
    {
        $date = $date ?? now()->toDateString(); // Mặc định hôm nay

        // Lấy danh sách học sinh của lớp
        $students = Student::where('classname', $classname)->where('status', 1)->get();

        // Lấy tất cả điểm danh của lớp và ngày được chọn
        $attendances = Attendance::where('classname', $classname)
            ->where('date', $date)
            ->get();

        // Lấy danh sách các ngày đã điểm danh (để hiển thị button)
        $attendanceDates = Attendance::where('classname', $classname)
            ->distinct()
            ->pluck('date');

        // Lấy tên lớp + grade từ model Account
        $classGrades = Account::$classGrades;
        $gradeLabel = $classGrades[$classname] ?? $classname;

        return view('admin.attendance.form', compact(
            'students',
            'classname',
            'gradeLabel',
            'date',
            'attendances',
            'attendanceDates'
        ));
    }


    public function store(Request $request)
    {
        $teacherId = session('auth_user')->id;
        $date = $request->date;
        $classname = $request->classname;

        foreach ($request->students as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $date,
                    'classname' => $classname,
                ],
                [
                    'teacher_id' => $teacherId,
                    'status' => $data['status'],
                    'note' => $data['note'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Điểm danh đã được lưu!');
    }
}
