<?php

namespace App\Http\Controllers;

use App\Models\Carausel;
use Illuminate\Http\Request;

class CarauselController extends Controller
{
    /**
     * Hiển thị danh sách carousel theo từng page
     */
    public function index(Request $request)
    {
        $carausels = Carausel::all();
        return view('admin.carausel.index', compact('carausels', ));
    }

    /**
     * Form thêm mới carousel
     */
    public function create()
    {
        $pages = Carausel::getTypes();
        return view('admin.carausel.create', compact('pages'));
    }

    /**
     * Lưu carousel mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable',
            'page' => 'required|in:1,2,3,4,5',
        ]);

        // Nếu page != TYPE_HOME, kiểm tra số lượng record hiện có
        if ($request->page != Carausel::TYPE_HOME) {
            $exists = Carausel::where('page', $request->page)->count();
            if ($exists > 0) {
                return redirect()->back()->withInput()
                    ->withErrors(['page' => 'Loại carousel này chỉ được phép 1 bản ghi.']);
            }
        }

        $filePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('carausels'), $filename);
            $filePath = 'carausels/' . $filename;
        }

        Carausel::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filePath,
            'status' => $request->has('status') ? 1 : 0,
            'page' => $request->page,
        ]);

        return redirect()->route('admin.carausel.index')->with('success', 'Thêm carousel thành công!');
    }


    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $carausel = Carausel::findOrFail($id);
        $pages = Carausel::getTypes();

        return view('admin.carausel.edit', compact('carausel', 'pages'));
    }

    /**
     * Cập nhật carousel
     */
    public function update(Request $request, $id)
    {
        $carausel = Carausel::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable',
            'page' => 'required|in:1,2,3,4,5'
        ]);

        // Kiểm tra giới hạn 1 record cho các type ngoại trừ TYPE_HOME
        if ($request->page != Carausel::TYPE_HOME) {
            $exists = Carausel::where('page', $request->page)
                ->where('id', '!=', $carausel->id)
                ->count();
            if ($exists > 0) {
                return redirect()->back()->withInput()
                    ->withErrors(['page' => 'Loại carousel này chỉ được phép 1 bản ghi.']);
            }
        }

        $carausel->title = $request->title;
        $carausel->description = $request->description;
        $carausel->status = $request->has('status') ? 1 : 0;
        $carausel->page = $request->page;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($carausel->image && file_exists(public_path($carausel->image))) {
                unlink(public_path($carausel->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('carausels'), $filename);
            $carausel->image = 'carausels/' . $filename;
        }

        $carausel->save();

        return redirect()->route('admin.carausel.index')->with('success', 'Cập nhật carousel thành công!');
    }


    /**
     * Xóa carousel
     */
    public function destroy(Carausel $carausel)
    {
        if ($carausel->image && file_exists(public_path($carausel->image))) {
            unlink(public_path($carausel->image));
        }

        $carausel->delete();

        return redirect()->route('admin.carausel.index')->with('success', 'Xóa carousel thành công!');
    }
}
