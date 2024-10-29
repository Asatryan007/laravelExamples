<x-app-layout>
    <div class="text-white p-4">
        <h1 class="text-2xl font-bold mb-4">Tasks</h1>

        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Create Task</a>

        <div class="filter mb-4">
            <h2 class="filter_title text-xl mb-2">Filter</h2>
            <form action="{{ route('tasks.index') }}" method="get" class="flex flex-col sm:flex-row items-start sm:items-center">
                <label for="status" class="mr-2">Status</label>
                <select class="text-black mb-2 sm:mb-0 sm:mr-2" name="status" id="status">
                    <option value="all" selected>All</option>
                    @php
                        $statusKeys = App\Models\Task::statusOptionKeys();
                    @endphp
                    @foreach ($statusKeys as $statusKey)
                        <option value="{{ $statusKey }}" {{ request('status') == $statusKey ? 'selected' : '' }}>
                            {{ App\Models\Task::statusLabel($statusKey) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Get Values</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-600 rounded">{{ session('success') }}</div>
        @endif

        @if($tasks->isEmpty())
            <div>No active Task</div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-white">
                    <thead>
                    <tr>
                        <th class="border border-white p-2">Title</th>
                        <th class="border border-white p-2">Started At</th>
                        <th class="border border-white p-2">Deadline</th>
                        <th class="border border-white p-2">Status</th>
                        <th class="border border-white p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="border border-white p-2">{{ $task->title }}</td>
                            <td class="border border-white p-2">{{ $task->startedAt ? $task->startedAt : 'non-privileged data' }}</td>
                            <td class="border border-white p-2">{{ $task->deadline ? $task->deadline : 'non-privileged data' }}</td>
                            <td class="border border-white p-2">{{ App\Models\Task::statusLabel($task->status) }}</td>
                            <td class="border border-white p-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-300 hover:underline">Edit</a>
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-300 hover:underline">Show</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $tasks->appends(['status' => request('status', 'all')])->links() }}
        @endif
    </div>
</x-app-layout>
