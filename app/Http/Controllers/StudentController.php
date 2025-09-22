<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classGrades = Student::$classGrades;
        return view('admin.students.create', compact('classGrades'));
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
            'note' => 'nullable|string|max:255',
            'gender' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('students'), $imageName);
            $validated['image'] = 'students/' . $imageName;
        }

        // convert gender
        $validated['gender'] = $request->gender ? 1 : 0;
        $validated['status'] = $request->status ? 1 : 0;

        Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
               $classGrades = Student::$classGrades;
        return view('admin.students.edit', compact('student','classGrades'));
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
            'birthday' => 'nullable|date',
            'age' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|boolean',
            'status' => 'required|boolean',
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

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }


    public function destroy(Student $student)
    {
        // Xóa ảnh nếu tồn tại
        if ($student->image && file_exists(public_path($student->image))) {
            unlink(public_path($student->image));
        }

        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
