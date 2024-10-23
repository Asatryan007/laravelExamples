@extends('layouts.app')

@section('content')
    <h2>Edit Task</h2>

    <form action="{{route('tasks.update', $task)}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="{{$task->title}}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10">{{$task->description}}</textarea>
        </div>
        <div>
            <label for="startedAt">Started At</label>
            <input type="date" name="startedAt" value="{{$task->startedAt}}">
        </div>
        <div>
            <label for="completedAt">Completed At</label>
            <input type="date" name = 'completedAt' value="{{$task->completedAt}}">
        </div>
        <div>
            <label for="deadline">Deadline</label>
            <input type="date" name = "deadline" value="{{$task->deadline}}">
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value=""  selected disabled>Please Select your status</option>
                <option value="1" {{$task->status ? 'selected': ''}}>Completed</option>
                <option value="0" {{!$task->status ? 'selected': ''}}>In Progress</option>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
