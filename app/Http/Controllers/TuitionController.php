<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use Illuminate\Http\Request;

class TuitionController extends Controller
{
 public function index()
    {
        $tuitions = Tuition::all();
        return view('admin.tuition.index', compact('tuitions'));
    }

    public function create()
    {
        return view('admin.tuition.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade' => 'required|string|max:255',
            'fee'   => 'required|integer|min:0',
            'note'  => 'nullable|string|max:255',
        ]);

        Tuition::create($request->all());

        return redirect()->route('admin.tuition.index')->with('success', 'Thêm mới thành công!');
    }

    public function edit(Tuition $tuition)
    {
        return view('admin.tuition.form', compact('tuition'));
    }

    public function update(Request $request, Tuition $tuition)
    {
        $request->validate([
            'grade' => 'required|string|max:255',
            'fee'   => 'required|integer|min:0',
            'note'  => 'nullable|string|max:255',
        ]);

        $tuition->update($request->all());
        $authUser = session('auth_user');
        return redirect()->route($authUser->role.'.tuition.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Tuition $tuition)
    {
           $authUser = session('auth_user');
        $tuition->delete();
        return redirect()->route($authUser->role.'.tuition.index')->with('success', 'Xóa thành công!');
    }
}
