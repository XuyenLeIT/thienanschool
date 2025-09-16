<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('images')->latest()->get();

        // Nếu chưa có dữ liệu -> tạo mặc định
        if ($galleries->isEmpty()) {
            $gallery = Gallery::create([
                'title' => 'Default Gallery',
                'description' => 'This is a default gallery created automatically.'
            ]);

            // Thêm ảnh mặc định (bạn thay link ảnh theo ý)
            $defaultImages = [
                'default1.jpg',
                'default2.jpg',
                'default3.jpg'
            ];

            foreach ($defaultImages as $img) {
                $gallery->images()->create([
                    'image_path' => 'galleries/' . $img
                ]);
            }

            // Reload lại dữ liệu
            $galleries = Gallery::with('images')->latest()->get();
        }

        return view('admin.galleries.index', compact('galleries'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Xử lý xoá ảnh được chọn
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $gallery->images()->find($imageId);
                if ($image) {
                    $filePath = public_path($image->image_path);
                    if (\File::exists($filePath)) {
                        \File::delete($filePath);
                    }
                    $image->delete();
                }
            }
        }

        // Upload thêm ảnh mới (tối đa 3 ảnh)
        $currentCount = $gallery->images()->count();
        $maxImages = 3;

        if ($request->hasFile('images')) {
            $newImages = $request->file('images');
            $allowedCount = $maxImages - $currentCount;

            if ($allowedCount <= 0) {
                return back()->withErrors(['images' => 'Gallery chỉ được phép tối đa ' . $maxImages . ' ảnh.']);
            }

            // Chỉ lấy đủ số ảnh còn thiếu
            foreach (array_slice($newImages, 0, $allowedCount) as $img) {
                $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('galleries'), $filename);

                $gallery->images()->create([
                    'image_path' => 'galleries/' . $filename
            ]);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated!');
    }


    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted!');
    }
    public function destroyImage(GalleryImages $image)
    {
        // Xoá file thật trong public
        $filePath = public_path($image->image_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Xoá record trong DB
        $image->delete();

        return back()->with('success', 'Image deleted!');
    }
}
