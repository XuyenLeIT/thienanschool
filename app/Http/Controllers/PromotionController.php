<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('id', 'desc')->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'required|in:1,2,3',
            'status' => 'nullable'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('promotions'), $filename);
            $imagePath = 'promotions/' . $filename;
        }

        Promotion::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'type' => $request->type,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Thêm promotion thành công!');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'type' => 'required|in:1,2,3',
            'status' => 'nullable'
        ]);

        $promotion->title = $request->title;
        $promotion->description = $request->description;
        $promotion->type = $request->type;
        $promotion->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($promotion->image && file_exists(public_path($promotion->image))) {
                unlink(public_path($promotion->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('promotions'), $filename);
            $promotion->image = 'promotions/' . $filename;
        }

        $promotion->save();

        return redirect()->route('admin.promotions.index')->with('success', 'Cập nhật promotion thành công!');
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->image && file_exists(public_path($promotion->image))) {
            unlink(public_path($promotion->image));
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('success', 'Xóa promotion thành công!');
    }
}
