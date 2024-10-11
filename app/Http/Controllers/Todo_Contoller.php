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

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $todos = Todo::create([
            'task' => $request->task,
            'description' => $request->description,
            'status' => $request->status,
            'date' => $request->date,
        ]);

        return response()->json($todos, 201);
    }
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'task' => 'required|max:255',
    //         'description' => 'required',
    //         'status' => 'nullable|in:pending,in_progress,completed',
    //         'date' => 'nullable|date',
    //     ]);

    //     $todo = Todo::create($validatedData);
    //     return response()->json($todo, 201);
    // }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'task' => 'required|max:255',
            'description' => 'required',
            'status' => 'nullable|in:pending,in_progress,completed',
            'date' => 'nullable|date',
        ]);

        $todo->update($validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully');
    }
}
