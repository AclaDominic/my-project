<?php

namespace App\Http\Controllers\api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Incoming Request:', $request->all()); // ✅ Log request data

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed ?? false, // Ensure default value
        ]);

        \Log::info('Created Task:', $task->toArray()); // ✅ Log stored data

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = true;
        $task->save();

        return response()->json([
            'message' => 'Task marked as completed',
            'task' => $task
        ]);
    }

}
