<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Todo_Contoller extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

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
            
            $todo = $request->user()->todos()->create($validatedData);
            return response()->json($todo, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $todo = Todo::with('user')->findOrFail($id);
            return response()->json($todo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Todo not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $todo = Todo::findOrFail($id);
            
            $validatedData = $request->validate([
                'task' => 'sometimes|required|max:255',
                'description' => 'sometimes|required',
                'status' => 'nullable|in:pending,in_progress,completed',
                'date' => 'nullable|date',
            ]);

            $todo->update($validatedData);
            return response()->json($todo->load('user'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Todo not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();
            return response()->json([
                'message' => 'Todo deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Todo not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}