@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <a href="{{route('tasks.create')}}">Create Task</a>

    @if(session('success'))
        <div>{{session('success')}}</div>
    @endif

    <ul>
        @foreach($tasks as $task)
            <li>
                {{$task->title}} -
                <a href="{{route('tasks.edit', $task)}}">Edit</a>
                <a href="{{route('tasks.show', $task)}}">Show</a>
                <form action="{{route('tasks.destroy', $task)}}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
