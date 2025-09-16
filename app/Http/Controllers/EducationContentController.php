<?php

namespace App\Http\Controllers;

use App\Models\EducationContent;
use App\Models\EducationItem;
use Illuminate\Http\Request;
class EducationContentController extends Controller
{
    // Index: hiển thị thông tin, khởi tạo mặc định nếu chưa có
    public function index()
    {
        $content = EducationContent::with('items')->first();

        if (!$content) {
            // Tạo dữ liệu mặc định
            $content = EducationContent::create([
                'title' => 'Nội dung giáo dục',
                'main_image' => 'education/default-main.jpg',
                'caption' => 'Chương trình kết hợp Montessori & Reggio Emilia — khuyến khích tự khám phá.',
                'description' => 'Mô tả tổng quan về chương trình giáo dục',
            ]);

            $defaultItems = [
                ['image' => 'education/default1.jpg', 'overlay_text' => 'Hoạt động sáng tạo', 'sort_order' => 1],
                ['image' => 'education/default2.jpg', 'overlay_text' => 'Khám phá khoa học', 'sort_order' => 2],
                ['image' => 'education/default3.jpg', 'overlay_text' => 'Âm nhạc & vận động', 'sort_order' => 3],
                ['image' => 'education/default4.jpg', 'overlay_text' => 'Hoạt động ngoại khóa', 'sort_order' => 4],
            ];

            foreach ($defaultItems as $item) {
                $content->items()->create($item);
            }
        }

        return view('admin.education.index', compact('content'));
    }

    // Form edit
    public function edit(EducationContent $educationContent)
    {
        return view('admin.education.edit', compact('educationContent'));
    }

    // Update
public function update(Request $request, EducationContent $educationContent)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        'caption' => 'nullable|string|max:500',
        'description' => 'nullable|string',
        'item_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        'overlay_texts.*' => 'nullable|string|max:255'
    ]);

    // ---- Xử lý main image ----
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = 'main_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('education'), $filename);
        $data['main_image'] = 'education/'.$filename;

        // Xóa ảnh cũ nếu muốn
        if ($educationContent->main_image && file_exists(public_path($educationContent->main_image))) {
            @unlink(public_path($educationContent->main_image));
        }
    }

    $educationContent->update($data);

    // ---- Xử lý item images ----
    if ($request->hasFile('item_images')) {
        foreach ($request->file('item_images') as $i => $file) {
            $filename = 'item_'.time().'_'.$i.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('education'), $filename);

            // Nếu item đã tồn tại thì update
            if (isset($educationContent->items[$i])) {
                $item = $educationContent->items[$i];

                // xóa file cũ
                if ($item->image && file_exists(public_path($item->image))) {
                    @unlink(public_path($item->image));
                }

                $item->update([
                    'image' => 'education/'.$filename,
                    'overlay_text' => $request->overlay_texts[$i] ?? $item->overlay_text
                ]);
            } else {
                // tạo mới nếu chưa có
                $educationContent->items()->create([
                    'image' => 'education/'.$filename,
                    'overlay_text' => $request->overlay_texts[$i] ?? null,
                    'sort_order' => $i
                ]);
            }
        }
    }

    return redirect()->route('admin.education.index')->with('success', 'Cập nhật thành công!');
}

}
