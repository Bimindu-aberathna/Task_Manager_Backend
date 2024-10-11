<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class Todo_Contoller extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'task' => 'required|max:255',
                'description' => 'required',
                'status' => 'nullable|in:pending,in_progress,completed',
                'date' => 'nullable|date',
            ]);

            $todo = Todo::create($validatedData);
            return response()->json($todo, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Todo $todo)
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        try {
            $validatedData = $request->validate([
                'task' => 'sometimes|required|max:255',
                'description' => 'sometimes|required',
                'status' => 'nullable|in:pending,in_progress,completed',
                'date' => 'nullable|date',
            ]);

            $todo->update($validatedData);
            return response()->json($todo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
