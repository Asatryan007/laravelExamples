<x-app-layout>
    <div class="container mx-auto text-white p-4">
        <h1 class="text-2xl font-bold mb-4 ">{{'Tasks'}} </h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Create Task</a>

        <div class="filter mb-40">
            <h2 class="filter_title text-xl mb-2">{{'Filter'}}</h2>
            <form action="{{ route('tasks.index') }}" method="get" class="flex flex-col sm:flex-row items-start sm:items-center">
                <label for="status" class="mr-2">Status:</label>
                <select class="text-black mb-2 sm:mb-0 sm:mr-2 cursor-pointer" name="status" id="status">
                    <option value="all" selected>All</option>
                    @php
                        $statusKeys = App\Models\UserTask::statusOptionKeys();
                    @endphp
                    @foreach ($statusKeys as $statusKey)
                        <option value="{{ $statusKey }}" {{ request('status') == $statusKey ? 'selected' : '' }}>
                            {{ App\Models\UserTask::statusLabel($statusKey) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{'Apply Filter'}}</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-600 rounded">{{ session('success') }}</div>
        @endif

        @if($tasks->isEmpty())
            <div>No active Task</div>
        @else
            <div class="overflow-x-auto hidden md:flex">
                <table class="min-w-full border-collapse border border-white">
                    <thead>
                    <tr>
                        <th class="border border-white p-2">Title</th>
                        <th class="border border-white p-2">Started At</th>
                        <th class="border border-white p-2">Deadline</th>
                        <th class="border border-white p-2">Status</th>
                        <th class="border border-white p-2">Other User`s Status</th>
                        <th class="border border-white p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php
                        $userTasks = auth()->user()->tasks()->withPivot('deadline')->get()->keyBy('id');
                    @endphp
                    @foreach($tasks as $task)
                        @php
                            $userTask = $userTasks->get($task->id);
                            $deadline = $userTask ? $userTask->pivot->deadline : 'non-privileged data';
                        @endphp
                        <tr>
                            <td class="border border-white p-2">{{ $task->title }}</td>
                            <td class="border border-white p-2">{{ $task->startedAt ? $task->startedAt : 'non-privileged data' }}</td>
                            <td class="border border-white p-2">{{ $deadline != null ? $deadline: 'non-privileged data' }}</td>
                            <td class="border border-white p-2">
                                <form class="flex flex-col space-y-2 content-between lg:flex-row md:justify-evenly" id="statusForm" action="{{route('tasks.statusUpdate',$task)}}" method="post">
                                    @csrf

                                    <select name="status" id="status" class="relative w-full text-black border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500">
                                        @php
                                            // Get the current user's task status from the pivot table
                                            $userTask = $task->users->firstWhere('id', auth()->id());
                                            $currentStatus = $userTask ? $userTask->pivot->status : null;
                                        @endphp

                                        @foreach (App\Models\UserTask::statusOptionKeys() as $statusKey)
                                            <option value="{{ $statusKey }}" {{ $currentStatus == $statusKey ? 'selected' : '' }}>
                                                {{ App\Models\UserTask::statusLabel($statusKey) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-primary-button>{{'Apply Status'}}</x-primary-button>
                                </form>
                            </td>
                            <td class="border border-white p-2">
                                @foreach ($task->users as $user)
                                    @if($task->parent_id != $user->pivot->user_id && $user->pivot->user_id != auth()->id())
                                        <div>{{ $user->name }}: {{ App\Models\UserTask::statusLabel($user->pivot->status) }}</div>
                                        <form
                                            action="{{route('tasks.detach',['userId'=> $user->id, 'taskId'=>$task->id,])}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="submit">Remove</x-primary-button>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                            <td class="flex flex-col content-between h-full space-y-2 border-t border-white p-2 lg:flex lg:justify-center lg:items-center">
                                @if ($task->parent_id === auth()->id())
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{ route('tasks.edit', $task) }}">{{ 'Edit' }}</a>
                                    </x-primary-button>
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{route('tasks.show',$task)}}">{{'Show'}}</a>
                                    </x-primary-button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="w-20 text-red-400 hover:underline">Delete</x-primary-button>
                                    </form>
                                @else
                                    <x-primary-button type="button" class="w-20 justify-center hover:underline">
                                        <a href="{{ route('tasks.edit', $task) }}">{{ 'Edit' }}</a>
                                    </x-primary-button>
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{route('tasks.show',$task)}}">{{'Show'}}</a>
                                    </x-primary-button>
                                    <x-primary-button type="button" class="w-20 text-red-400 opacity-50  cursor-not-allowed" disabled>
                                        {{'Delete'}}
                                    </x-primary-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex overflow-x-auto justify-self-auto md:hidden ">
                @foreach($tasks as $task)
                    @php
                        $userTask = $userTasks->get($task->id);
                        $deadline = $userTask ? $userTask->pivot->deadline : 'non-privileged data';
                    @endphp
                    <table class="min-w-fit mr-5 border-collapse border border-white">
                        <tr>
                            <th class="border border-white p-2">Title</th>
                            <td class="border border-white p-2">{{$task->title}}</td>
                        </tr>
                        <tr>
                            <th class="border border-white p-2">Started At</th>
                            <td class="border border-white p-2">{{ $task->startedAt ? $task->startedAt : 'non-privileged data' }}</td>
                        </tr>
                        <tr>
                            <th class="border border-white p-2">Deadline</th>
                            <td class="border border-white p-2">{{ $deadline != null ? $deadline: 'non-privileged data' }}</td>
                        </tr>
                        <tr>
                            <th class="border border-white p-2">Status</th>
                            <td class="border border-white p-2">
                                <form class="flex flex-col space-y-2" id="statusForm" action="{{route('tasks.statusUpdate',$task)}}" method="post">
                                    @csrf

                                    <select name="status" id="status" class="relative w-full text-black border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500">
                                        @php
                                            // Get the current user's task status from the pivot table
                                            $userTask = $task->users->firstWhere('id', auth()->id());
                                            $currentStatus = $userTask ? $userTask->pivot->status : null;
                                        @endphp

                                        @foreach (App\Models\UserTask::statusOptionKeys() as $statusKey)
                                            <option value="{{ $statusKey }}" {{ $currentStatus == $statusKey ? 'selected' : '' }}>
                                                {{ App\Models\UserTask::statusLabel($statusKey) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-primary-button>{{'Apply Status'}}</x-primary-button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th class="border border-white p-2">Other User`s Status</th>
                            <td class="flex flex-col  border-white p-2">
                                @foreach ($task->users as $user)
                                    @if($task->parent_id != $user->pivot->user_id && $user->pivot->user_id != auth()->id())
                                        <div>{{ $user->name }}: {{ App\Models\UserTask::statusLabel($user->pivot->status) }}</div>
                                        <form
                                            action="{{route('tasks.detach',['userId'=> $user->id, 'taskId'=>$task->id,])}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="submit">Remove</x-primary-button>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th class="border border-white p-2">Actions</th>
                            <td class="flex flex-col justify-end items-center border-t  border-white space-y-2 p-2">
                                @if ($task->parent_id === auth()->id())
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{ route('tasks.edit', $task) }}">{{ 'Edit' }}</a>
                                    </x-primary-button>
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{route('tasks.show',$task)}}">{{'Show'}}</a>
                                    </x-primary-button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="w-20 text-red-400 hover:underline">Delete</x-primary-button>
                                    </form>
                                @else
                                    <x-primary-button type="button" class="w-20 justify-center hover:underline">
                                        <a href="{{ route('tasks.edit', $task) }}">{{ 'Edit' }}</a>
                                    </x-primary-button>
                                    <x-primary-button type="submit" class="w-20 justify-center hover:underline">
                                        <a href="{{route('tasks.show',$task)}}">{{'Show'}}</a>
                                    </x-primary-button>
                                    <x-primary-button type="button" class="w-20 text-red-400 opacity-50  cursor-not-allowed" disabled>
                                        {{'Delete'}}
                                    </x-primary-button>
                                @endif
                            </td>
                        </tr>
                    </table>
                @endforeach
            </div>
            {{ $tasks->appends(['status' => request('status', 'all')])->links() }}
        @endif
    </div>
</x-app-layout>
