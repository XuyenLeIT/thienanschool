<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        // lấy record đầu tiên hoặc tạo mới nếu chưa có
        $about = About::firstOrCreate([], [
            'title' => 'Tiêu đề mặc định',
            'description' => 'Nội dung giới thiệu mặc định',
        ]);

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $about = About::first();
        // cập nhật dữ liệu
        $data = $request->only(['title', 'description']);
        if ($request->hasFile('image')) {
            // Lấy file upload
            $file = $request->file('image');
            // Tạo tên file duy nhất
            $filename = time() . '_' . $file->getClientOriginalName();
            // Di chuyển vào thư mục public/carausels
            $file->move(public_path('abouts'), $filename);
            $data['image'] = 'abouts/' . $filename;
        }
        $about->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
}
