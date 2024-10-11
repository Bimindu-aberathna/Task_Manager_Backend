@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>
    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Create New Todo</a>
    <table class="table">
        <thead>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
                <tr>
                    <td>{{ $todo->task }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->status }}</td>
                    <td>{{ $todo->date }}</td>
                    <td>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection