<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MenuController extends Controller
{
  public function index(Request $request)
{
    $menus = Menu::orderBy('order')->get();

    // Lấy hôm nay theo múi giờ Việt Nam
    $today = Carbon::now('Asia/Ho_Chi_Minh');

    // Nếu có tham số ?week=next thì lấy tuần tới
    if ($request->query('week') === 'next') {
        $startOfWeek = $today->copy()->addWeek()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->addWeek()->endOfWeek(Carbon::SATURDAY);
    } else {
        // Mặc định là tuần hiện tại
        $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SATURDAY);
    }

    // Format ngày tháng theo dạng dd/mm
    $weekRange = $startOfWeek->format('d/m') . ' - ' . $endOfWeek->format('d/m');

    return view('admin.menus.index', compact('menus', 'weekRange'));
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

        return redirect()->route('manager.menus.index')->with('success', 'Thêm thực đơn thành công!');
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

        return redirect()->route('manager.menus.index')->with('success', 'Cập nhật thực đơn thành công!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('manager.menus.index')->with('success', 'Xóa thực đơn thành công!');
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
