<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::query();

        // Filter trạng thái liên hệ
        if ($request->filled('status')) {
            if ($request->status === 'contacted') {
                $query->where('status', 1);
            } elseif ($request->status === 'not_contacted') {
                $query->where('status', 0);
            }
        }

        // Filter kết quả (success / fail)
        if ($request->filled('result')) {
            if ($request->result === 'success') {
                $query->where('result', 1); // Bé đồng ý nhập học
            } elseif ($request->result === 'fail') {
                $query->where('result', 0); // Thất bại - Đang tham khảo
            }
        }

        // Filter theo ngày
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Search theo tên phụ huynh hoặc bé
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('parent_name', 'like', "%$search%")
                    ->orWhere('child_name', 'like', "%$search%");
            });
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.registrations.index', compact('registrations'));
    }



    public function toggleStatus($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->status = !$registration->status;
        $registration->save();

        return redirect()->back()->with('success', 'Trạng thái đã được cập nhật!');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'child_name' => 'required|string|max:255',
            'age_group' => 'required|string',
            'note' => 'nullable|string',
        ]);

        Registration::create($validated);

        return response()->json(['message' => 'Đăng ký thành công!']);
    }
    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }

    // Cập nhật kết quả liên hệ (AJAX)
    public function updateResult(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $request->validate([
            'status' => 'required|boolean',
            'result' => 'nullable|boolean',
            'note_result' => 'nullable|string|max:500',
        ]);

        $registration->status = $request->status;
        $registration->result = $request->result;
        $registration->note_result = $request->note_result;
        $registration->save();

        return response()->json([
            'message' => 'Cập nhật kết quả liên hệ thành công.',
        ]);
    }

}
