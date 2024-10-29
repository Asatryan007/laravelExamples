<x-app-layout>

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
            <input type="date" name='completedAt' value="{{$task->completedAt}}">
        </div>
        <div>
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" value="{{$task->deadline}}">
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                @foreach (App\Models\Task::statusOptionKeys() as $status)
                    <option
                        value="{{$status}}" {{ $task->status == $status ? 'selected' : '' }}>
                        {{ App\Models\Task::statusLabel($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
        <a href="{{route('tasks.index')}}">
            <button>Cancel</button>
        </a>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
