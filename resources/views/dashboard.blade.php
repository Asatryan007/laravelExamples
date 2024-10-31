<x-app-layout>
    <div class="container  flex flex-col  mx-auto px-4">
        <h1 class="text-2xl flex justify-center  text-white font-bold my-3">Dashboard</h1>

        <div class="flex flex-col justify-between lg:flex-row">
            <!-- User Overview Section -->
            <div class="bg-gray-800 p-4 rounded flex flex-col ">
                <div class=" flex text-gray-400 space-x-8">
                    <div class="w-full flex flex-col space-x-8  space-y-2">
                        <h2 class=" text-base sm:text-2xl">State Of The Tasks</h2>
                        <div class="text-left">
                            <p class = 'flex justify-between text-gray-300 text-xs sm:text-lg'>Tasks To Do: <span class="">{{$todoTasksCount}}</span></p>
                            <p class = 'flex justify-between text-gray-300 text-xs sm:text-lg'>Tasks In Progress: <span class="">{{ $pendingTasksCount }}</span></p>
                            <p class = 'flex justify-between text-gray-300 text-xs sm:text-lg'>Tasks Review: <span class="">{{$reviewTasksCount}}</span></p>
                            <p class = 'flex justify-between text-gray-300 text-xs sm:text-lg'>Tasks Completed: <span class="">{{ $completedTasksCount }}</span></p>
                        </div>
                    </div>
                    <div>
                        <x-primary-button><a href="{{route('tasks.index')}}">ALL Tasks</a></x-primary-button>
                    </div>
                </div>

                <table class="w-fit md:min-w-64 text-center justify-center border-collapse border text-gray-400 border-white mt-5">
                    <thead>
                    <tr>
                        <th class="border border-white text-lg p-2">Title</th>
                        <th class="border border-white text-lg p-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lastTasks as $task)
                        <tr>
                            <td class="border border-white p-2">{{ $task->title }}</td>
                            <td class="border flex flex-col space-y-2 justify-center items-center sm:space-x-2 sm:space-y-0 sm:flex-row border-white p-2 ">
                                <x-primary-button type="submit" class="w-20 justify-center hover:underline"><a  href="{{ route('tasks.edit', $task) }}">{{'Edit'}}</a></x-primary-button>
                                <x-primary-button type="submit" class="w-20 justify-center hover:underline"><a href="{{route('tasks.show',$task)}}">{{'Show'}}</a></x-primary-button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="w-20 text-red-400 hover:underline">Delete</x-primary-button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tasks Overview Section -->
            @if($totalTasks!= 0)
            <div class="bg-gray-800 p-4 rounded flex justify-center">
                <canvas id="taskPieChart"  style="width: 600px; height: 600px;"></canvas>
            </div>
        </div>
        <script>
            const todoTasksCount = {{ $todoTasksCount }};
            const pendingTasksCount = {{ $pendingTasksCount }};
            const reviewTasksCount = {{ $reviewTasksCount }};
            const completedTasksCount = {{ $completedTasksCount }};
        </script>
        <script src="{{ asset('js/taskChart.js') }}"></script>
    @endif

</x-app-layout>
