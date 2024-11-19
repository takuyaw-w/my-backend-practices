<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        return response()->json($task, 200);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($validated);
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully', 200]);
    }
}
