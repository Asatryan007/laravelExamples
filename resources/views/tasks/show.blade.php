<x-app-layout>
    <div class="container mx-auto">
        <div class="text-white p-4">
            <h1 class="text-2xl mb-4"><a href="{{route('tasks.index')}}">{{'Tasks'}}</a></h1>

            <a href="{{ route('tasks.create') }}"
               class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 mb-4 inline-block">
                Create Task
            </a>

            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto hidden md:flex">
                <table class="min-w-full text-center bg-gray-800 border border-gray-600">
                    <thead>
                    <tr class="bg-gray-700">
                        <th class="py-2 px-4 border-b text-center">Title</th>
                        <th class="py-2 px-4 border-b text-center">Description</th>
                        <th class="py-2 px-4 border-b text-center">Started At</th>
                        <th class="py-2 px-0 border-b  text-center">Completed At</th>
                        <th class="py-2 px-4 border-b text-center">Deadline</th>
                        <th class="py-2 px-4 border-b text-center">Status</th>
                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-gray-600">
                        <td class="py-2 px-4 border-b">{{ $task->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->description }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->startedAt ? $task->startedAt : 'non-privileged data' }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->completedAt ? $task->completedAt : 'non-privileged data' }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->deadline ? $task->deadline : 'non-privileged data' }}</td>
                        <td class="py-2 px-4 border-b">{{ \App\Models\Task::statusLabel($task->status) }}</td>
                        <td class="py-2 px-4 border-b flex flex-col space-y-2  md:grid md:place-items-center">
                            <x-primary-button type="submit" class="justify-center w-20 hover:underline "><a
                                    href="{{route('tasks.edit',$task)}}">{{'Edit'}}</a></x-primary-button>
                            <x-primary-button type="submit" class="justify-center w-20 hover:underline"><a
                                    href="{{route('tasks.index')}}">{{'All'}}</a></x-primary-button>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit" class="w-20 text-red-400 hover:underline">Delete
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="overflow-x-auto flex md:hidden">
            <table class="min-w-full text-white text-center bg-gray-800 border border-gray-600">
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Title</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{$task->title}}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Description</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{$task->description}}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Started At</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{ $task->startedAt ? $task->startedAt : 'non-privileged data' }}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Completed At</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{ $task->completedAt ? $task->completedAt : 'non-privileged data' }}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Deadline</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{ $task->deadline ? $task->deadline : 'non-privileged data' }}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Status</th>
                    <td class="border border-white p-2 hover:bg-gray-600">{{ App\Models\Task::statusLabel($task->status) }}</td>
                </tr>
                <tr>
                    <th class="border bg-gray-700 border-r p-2">Actions</th>
                    <td class="border border-white p-2 flex  flex-col justify-center items-center space-y-2 sm:flex-row sm:justify-between sm:items-center  hover:bg-gray-600">
                        <x-primary-button type="submit" class="w-20 justify-center hover:underline sm:mt-2 "><a
                                href="{{ route('tasks.edit', $task) }}">{{'Edit'}}</a></x-primary-button>
                        <x-primary-button type="submit" class="w-20 justify-center hover:underline"><a
                                href="{{route('tasks.index')}}">{{'All'}}</a></x-primary-button>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit" class="w-20 text-red-400 hover:underline">Delete
                            </x-primary-button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</x-app-layout>
