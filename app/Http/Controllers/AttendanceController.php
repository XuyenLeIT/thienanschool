<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create($classname)
    {
        // $students = Student::where('classname', $classname)->where('status', 1)->get();
        // $today = now()->toDateString();
        // return view('admin.attendance.create', compact('students', 'classname', 'today'));
        $teacher = session('auth_user');
        $classname = $teacher->classname;
        $students = Student::where('classname', $classname)->where('status', 1)->get();
        $today = now()->toDateString();

        return view('admin.attendance.create', compact('students', 'classname', 'today'));

    }

    public function store(Request $request)
    {
        $teacherId = auth()->id(); // id giáo viên đang login
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

        return redirect()->back()->with('success', 'Điểm danh thành công!');
    }
}
