<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Lấy input từ query string
        $classname = $request->input('classname');
        $status = $request->input('status');
        $sDelete = $request->input('s_delete', '0'); // mặc định 0 (chưa xóa)
        $search = $request->input('search');

        // Query cơ bản
        $query = Student::query();

        // Lọc theo s_delete
        if ($sDelete !== '') {
            $query->where('s_delete', $sDelete);
        }

        // Lọc theo lớp
        if (!empty($classname)) {
            $query->where('classname', $classname);
        }

        // Lọc theo trạng thái học
        if ($status !== '' && $status !== null) {
            $query->where('status', $status);
        }

        // Tìm kiếm theo tên học sinh hoặc phụ huynh
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('parent', 'like', "%{$search}%");
            });
        }

        // Lấy danh sách
        $students = $query->orderBy('fullname')->paginate(10);

        // Dữ liệu cho form filter
        $classGrades = Student::$classGrades;
        $statusList = Student::$statusList;

        return view('admin.students.index', compact(
            'students',
            'classGrades',
            'statusList',
            'classname',
            'status',
            'sDelete',
            'search'
        ));
    }


    public function create()
    {
        $statusList = Student::$statusList;
        $classGrades = Student::$classGrades;
        return view('admin.students.create', compact('classGrades', 'statusList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'grade' => 'nullable|string|max:50',
            'startdate' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'classname' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'bod' => 'nullable|date',
            'note' => 'nullable|string|max:255',
            'gender' => 'required|boolean',
            'status' => 'required',
        ]);

        // xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('students'), $imageName);
            $validated['image'] = 'students/' . $imageName;
        }

        // convert gender
        $validated['gender'] = $request->gender ? 1 : 0;

        Student::create($validated);
        $authUser = session('auth_user');
        return redirect()->route($authUser->role . '.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classGrades = Student::$classGrades;
        $statusList = Student::$statusList;
        return view('admin.students.edit', compact('student', 'classGrades', 'statusList'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'grade' => 'nullable|string|max:50',
            'classname' => 'nullable|string|max:255',
            'startdate' => 'nullable|date',
            'bod' => 'nullable|date',
            'age' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|boolean',
            'status' => 'required',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('students'), $imageName);
            $validated['image'] = 'students/' . $imageName;
        }

        $student->update($validated);
        $authUser = session('auth_user');
        return redirect()->route($authUser->role . '.students.index')
            ->with('success', 'Student updated successfully.');
    }


    public function destroy(Student $student)
    {
        $authUser = session('auth_user');
        // Chuyển sang trạng thái xoá mềm
        $student->update([
            's_delete' => true
        ]);

        return redirect()->route($authUser->role . '.students.index')
            ->with('success', 'Student has been moved to trash successfully.');
    }
    public function restore($id)
    {
        $student = Student::findOrFail($id);
        $student->update(['s_delete' => false]);
        $authUser = session('auth_user');
        return redirect()->route($authUser->role . '.students.index')
            ->with('success', 'Student restored successfully.');
    }
}
