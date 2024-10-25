@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

    <a href="{{route('tasks.create')}}">Create Task</a>

    @if(session('success'))
        <div>{{session('success')}}</div>
    @endif
    @if(count($tasks) === 0)
        <div>No active Task</div>
    @endif
    @if(count($tasks) != 0)
        <table>
            <tr>
                <th>Title</th>
                <th>Started At</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            @foreach($tasks as $task)
                <tr>
                    <td>{{$task->title}}</td>
                    <td>{{$task->startedAt ? $task->startedAt:'non-privileged data'}}</td>
                    <td>{{$task->deadline ? $task->deadline:'non-privileged data'}}</td>
                    <td>{{$task->status}}</td>
                    <td>
                        <a href="{{route('tasks.edit', $task)}}">Edit</a>
                        <a href="{{route('tasks.show', $task)}}">Show</a>
                        <form action="{{route('tasks.destroy', $task)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
