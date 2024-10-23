@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <a href="{{route('tasks.create')}}">Create Task</a>

            <div>
                <p>{{$task->title}} -
                    <a href="{{route('tasks.edit', $task)}}">Edit</a></p>
                <div><p>Description:</p><p>{{$task->description}}</p></div>
                <div><p>Started At:</p><p>{{$task->startedAt}}</p></div>
                <div><p>Completed At:</p><p>{{$task->completedAt}}</p></div>
                <div><p>Deadline:</p><p>{{$task->deadline}}</p></div>
                <div><p>Status:</p><p>{{$task->status? "Completed":'In prgress'}}</p></div>
                <form action="{{route('tasks.destroy', $task)}}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
@endsection
