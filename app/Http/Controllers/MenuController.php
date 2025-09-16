<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        // Dùng chung form view
        return view('admin.menus.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'day' => 'required|string|max:50',
            'breakfast' => 'required|string',
            'lunch' => 'required|string',
            'snack' => 'required|string',
        ]);

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Thêm thực đơn thành công!');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.form', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'day' => 'required|string|max:50',
            'breakfast' => 'required|string',
            'lunch' => 'required|string',
            'snack' => 'required|string',
        ]);

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Cập nhật thực đơn thành công!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Xóa thực đơn thành công!');
    }
    public function sort(Request $request)
    {
        $order = $request->order; 

        foreach ($order as $index => $id) {
            $menu = Menu::find($id);
            if ($menu) {
                $menu->order = $index + 1;
                $menu->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

}
