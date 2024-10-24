@extends('layouts.app')

@section('content')
    <h2>Create Task</h2>

    <form action="{{route('tasks.store')}}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="startedAt">Started At</label>
            <input type="date" name="startedAt">
        </div>
        <div>
            <label for="completedAt">Completed At</label>
            <input type="date" name = 'completedAt'>
        </div>
        <div>
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
