<?php

namespace App\Http\Controllers;

use App\Models\ParentNotice;
use Illuminate\Http\Request;

class ParentNoticeController extends Controller
{
    public function index()
    {
        $notices = ParentNotice::orderBy('created_at', 'desc')->get();
        return view('admin.parent_notices.index', compact('notices'));
    }
    public function create()
    {
        return view('admin.parent_notices.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable'
        ]);

        ParentNotice::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.parent_notices.index')->with('success', 'Thêm thông báo thành công!');
    }

    public function edit($id)
    {
        $notice = ParentNotice::findOrFail($id);
        return view('admin.parent_notices.form', compact('notice'));
    }
    public function update(Request $request, $id)
    {
        $notice = ParentNotice::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable'
        ]);

        $notice->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.parent_notices.index')->with('success', 'Cập nhật thông báo thành công!');
    }
    public function destroy($id)
    {
        ParentNotice::findOrFail($id)->delete();
        return redirect()->route('admin.parent_notices.index')->with('success', 'Xóa thông báo thành công!');
    }

}
