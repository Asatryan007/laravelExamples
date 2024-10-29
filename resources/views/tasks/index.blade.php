<x-app-layout>
    <div class="text-white">
    <h1>Tasks</h1>

    <a href="{{route('tasks.create')}}">Create Task</a>

    <div class="filter">
        <h2 class="filter_title">Filter</h2>
        <form action="{{route('tasks.index')}}" method='get'>
            <label for="status">Status</label>
            <select class="text-black" name="status" id="status">
                <option value="all" selected>All</option>
                @php
                    $statusKeys = App\Models\Task::statusOptionKeys()
                @endphp
                @foreach ($statusKeys as $statusKey)
                    <option
                        value="{{$statusKey}}" {{request('status') == $statusKey ? 'selected' : '' }}>
                        {{ App\Models\Task::statusLabel($statusKey) }}
                    </option>
                @endforeach
            </select>
            <button type="submit">Get Values</button>
        </form>
    </div>

    @if(session('success'))
        <div>{{session('success')}}</div>
    @endif

    @if($tasks->isEmpty())
        <div>No active Task</div>
    @else
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

        {{ $tasks->appends(['status' => request('status', 'all')])->links() }}
    @endif
    </div>
</x-app-layout>
