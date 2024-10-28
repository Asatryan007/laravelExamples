@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>

    <a href="{{route('tasks.create')}}">Create Task</a>

    <div class="filter">
        <h2 class="filter_title">Filter</h2>
        <form action="{{route('tasks.filter')}}" method = 'post'>
            @csrf
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Choose The status" selected >Choose the status</option>
                @foreach (App\Models\Task::statusOptionKeys() as $status)
                    <option
                        value="{{$status}}" {{request('status') == $status ? 'selected' : '' }}>
                        {{ App\Models\Task::statusLabel($status) }}
                    </option>
            @endforeach
                <option value="all">All</option>
            </select>
            <button type="submit">Get  Values</button>
        </form>
    </div>

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
                    <td>{{App\Models\Task::statusLabel($task->status)}}</td>
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
