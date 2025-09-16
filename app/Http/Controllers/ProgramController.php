<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'type' => 'required|in:1,2,3', // ví dụ có thêm type 3
        ]);

        Program::create($validated);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Program created!');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'type' => 'required|in:1,2'
        ]);

        $program->update($validated);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Program updated!');
    }


    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program deleted!');
    }
}
