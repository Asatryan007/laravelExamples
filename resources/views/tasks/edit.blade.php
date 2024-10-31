<x-app-layout>
    <div class="container mx-auto px-5">
        <h2 class="text-white flex justify-center items-center text-2xl mb-4 mt-4">{{'Edit Task'}}</h2>

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="max-w-lg mx-auto p-6 bg-gray-500 rounded-lg">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-black">Title</label>
                <input type="text" value="{{$task->title}}" name="title" required maxlength="255" class="w-full p-2 border border-white bg-gray-300 text-black">
                @error('title')
                <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-8">
                <label for="description" class="block text-black">Description</label>
                <textarea name="description" cols="30" rows="10" class="w-full p-2 border border-white bg-gray-300 text-black">{{$task->description}}</textarea>
                @error('description')
                <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="startedAt" class="block text-black">Choose the starting date.</label>
                <input type="date" name="startedAt" value="{{$task->startedAt}}" class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="startedAt" class="block text-black">Choose the completion date.</label>
                <input type="date" name="completedAt" value="{{$task->completedAt}}" class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="deadline" class="block text-black">Select the date for the deadline.</label>
                <input type="date" name="deadline" value="{{$task->deadline}}" class="w-full p-2 border border-white bg-gray-300 text-black">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="relative w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500">
                    @foreach (App\Models\Task::statusOptionKeys() as $status)
                        <option  value="{{ $status }}" {{ $task->status == $status ? 'selected' : '' }}>
                            {{ App\Models\Task::statusLabel($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    {{'Update'}}
                </button>
                <button type="button" class="bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">
                    <a href="{{ route('tasks.index') }}"> {{'Cancel'}} </a>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
