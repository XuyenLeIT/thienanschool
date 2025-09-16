<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('id')->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('admin.feedbacks.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'feedback' => 'required|string',
            'status' => 'nullable',
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $filename);
            $avatarPath = '/avatars/' . $filename;
        }

        $feedback = Feedback::create([
            'name' => $request->name,
            'parent' => $request->parent,
            'avatar' => $avatarPath,
            'feedback' => $request->feedback,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback created successfully.');
    }


    public function edit(Feedback $feedback)
    {
        return view('admin.feedbacks.form', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'feedback' => 'required|string',
            'status' => 'nullable',
        ]);

        // Nếu upload avatar mới thì xóa cũ
        if ($request->hasFile('avatar')) {
            if ($feedback->avatar && file_exists(public_path($feedback->avatar))) {
                unlink(public_path($feedback->avatar));
            }

            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('avatars'), $filename);
            $feedback->avatar = '/avatars/' . $filename;
        }

        $feedback->name = $request->name;
        $feedback->parent = $request->parent;
        $feedback->feedback = $request->feedback;
        $feedback->status = $request->has('status') ? 1 : 0;

        $feedback->save();

        return redirect()->route('admin.feedbacks.index')
            ->with('success', 'Feedback updated successfully.');
    }


    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedbacks.index')->with('success', 'Xóa feedback thành công!');
    }

    // API JSON
    public function apiFeedbacks()
    {
        return response()->json(Feedback::where('status', 1)->get());
    }
}
