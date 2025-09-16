<?php

namespace App\Http\Controllers;

use App\Models\SpecialFeature;
use Illuminate\Http\Request;

class SpecialFeatureController extends Controller
{    // Index: hiển thị dữ liệu
    public function index()
    {
        $feature = SpecialFeature::with(['images', 'subdes'])->first();

        // Nếu chưa có record, tạo mặc định
        if (!$feature) {
            $feature = SpecialFeature::create([
                'title' => 'Default Title',
                'description' => 'Default description for special feature.'
            ]);
        }

        return view('admin.special_features.index', compact('feature'));
    }


    // Update dữ liệu
    public function edit($id)
    {
        $feature = SpecialFeature::with(['images', 'subdes'])->findOrFail($id);
        return view('admin.special_features.form', compact('feature'));
    }

    public function update(Request $request, $id)
    {
        $feature = SpecialFeature::findOrFail($id);

        // Update feature chính
        $feature->update($request->only('title', 'description'));
        // Xử lý ảnh nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('special_features');
                $file->move($destinationPath, $filename);

                // Lưu đường dẫn vào DB
                $feature->images()->create(['image' => 'special_features/' . $filename]);
            }
        }

        // Xóa ảnh được chọn
        if ($request->delete_images) {
            foreach ($request->delete_images as $imgId) {
                $img = $feature->images()->find($imgId);
                if ($img) {
                    // Xóa file vật lý
                    $filePath = public_path($img->image);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    // Xóa DB record
                    $img->delete();
                }
            }
        }

        // Xóa toàn bộ subdes cũ rồi thêm lại
        $feature->subdes()->delete();
        if ($request->subdes_title) {
            foreach ($request->subdes_title as $index => $title) {
                $desc = $request->subdes_description[$index] ?? '';
                $icon_class = $request->subdes_icon_class[$index] ?? ''; // <-- sửa ở đây
                $feature->subdes()->create([
                    'title' => $title,
                    'icon_class' => $icon_class,
                    'description' => $desc
                ]);
            }
        }


        return redirect()->route('admin.special_features.index')->with('success', 'Updated successfully!');
    }


}
