<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
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
        $validatedData = $request->validate([
            'task' => 'required|max:255',
            'description' => 'required',
            'status' => 'nullable|in:pending,in_progress,completed',
            'date' => 'nullable|date',
        ]);

        Todo::create($validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully');
    }

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