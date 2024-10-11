@extends('layouts.app')

@section('content')
    <h1>Edit Todo</h1>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="task" class="form-label">Task</label>
            <input type="text" class="form-control" id="task" name="task" value="{{ $todo->task }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $todo->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" {{ $todo->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $todo->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $todo->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $todo->date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Todo</button>
    </form>
@endsection