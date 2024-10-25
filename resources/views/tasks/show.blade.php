@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

    <a href="{{route('tasks.create')}}">Create Task</a>

    @if(session('success'))
        <div>{{session('success')}}</div>
    @endif

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Started At</th>
            <th>Completed At</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{$task->title}}</td>
            <td>{{$task->description}}</td>
            <td>{{$task->startedAt ? $task->startedAt:'non-privileged data'}}</td>
            <td>{{$task->completedAt ? $task->completedAt:'non-privileged data' }}</td>
            <td>{{$task->deadline ? $task->deadline:'non-privileged data'}}</td>
            <td>{{$task->status}}</td>
            <td>
                <a href="{{route('tasks.edit', $task)}}">Edit</a>
                <a href="{{route('tasks.index')}}">All</a>
                <form action="{{route('tasks.destroy', $task)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    </table>
@endsection
