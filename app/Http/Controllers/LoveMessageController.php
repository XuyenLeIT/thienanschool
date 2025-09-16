<?php

namespace App\Http\Controllers;

use App\Models\LoveMessage;
use Illuminate\Http\Request;

class LoveMessageController extends Controller
{
    public function index()
    {
        $messages = LoveMessage::all();
        return view('admin.love_messages.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.love_messages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'message' => 'required|string',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('avatars'), $filename);
        $data['avatar'] = 'avatars/' . $filename;
        }

        LoveMessage::create($data);
        return redirect()->route('admin.love-messages.index')->with('success', 'Thêm thành công!');
    }

    public function edit(LoveMessage $loveMessage)
    {
        return view('admin.love_messages.edit', compact('loveMessage'));
    }

    public function update(Request $request, LoveMessage $loveMessage)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'message' => 'required|string',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('avatars'), $filename);
        $data['avatar'] = 'avatars/' . $filename;
        }

        $loveMessage->update($data);
        return redirect()->route('admin.love-messages.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(LoveMessage $loveMessage)
    {
        $loveMessage->delete();
        return redirect()->route('admin.love-messages.index')->with('success', 'Xóa thành công!');
    }
}
