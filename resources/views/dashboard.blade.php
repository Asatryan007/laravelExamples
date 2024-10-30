<x-app-layout>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- User Overview Section -->
            <div class="bg-gray-800 p-4 rounded">
                <h2 class="text-xl">User Overview</h2>
                <p>Name: {{ Auth::user()->name }}</p>
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Tasks Completed: {{ $completedTasksCount}}</p>
                <p>Tasks In Progress: {{ $pendingTasksCount }}</p>
            </div>

            <!-- Tasks Overview Section -->
            <div class="bg-gray-800 p-4 rounded">
                <h2 class="text-xl">Tasks Overview</h2>
                <p>Total Tasks: {{ $totalTasks }}</p>
                <p>Completed: {{ $completedTasksCount }}</p>
                <p>Pending: {{ $pendingTasksCount }}</p>
                <p>Overdue: {{ $overdueTasksCount }}</p>
                <div class="mt-2 flex flex-col justify-between ">
                    <p>Completed Tasks Percentage:</p><progress value="{{ $completedTasksPercentage }}" max="100" class="w-half"></progress><span class=" text-white">{{$completedTasksPercentage."%"}}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
