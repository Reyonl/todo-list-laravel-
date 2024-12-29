<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
        ]);

        Task::create([
            'title' => $validated['title'],
            'notes' => $validated['notes'],
            'completed' => false,
        ]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function update(Request $request, Task $task)
    {
        // Validasi input
        $validated = $request->validate([
            'notes' => 'nullable|string|max:255',
        ]);

        // Perbarui catatan
        $task->update(['notes' => $validated['notes']]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Task updated successfully!');
    }
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/');
    }
}
