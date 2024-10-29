<x-app-layout>
    <h2 class="text-white flex justify-center items-center text-2xl mb-4 mt-4">Create Task</h2>

    <form action="{{ route('tasks.store') }}" method="POST" class="max-w-lg mx-auto p-6 bg-gray-500 rounded-lg">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-black">Title</label>
            <input type="text" name="title" required maxlength="255" class="w-full p-2 border border-white bg-gray-300 text-black">
            @error('title')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block text-black">Description</label>
            <textarea name="description" cols="30" rows="10" class="w-full p-2 border border-white bg-gray-300 text-black"></textarea>
            @error('description')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="startedAt" class="block text-black">Started At</label>
            <input type="date" name="startedAt" class="w-full p-2 border border-white bg-gray-300 text-black">
        </div>
        <div class="mb-4">
            <label for="completedAt" class="block text-black">Completed At</label>
            <input type="date" name="completedAt" class="w-full p-2 border border-white bg-gray-300 text-black">
        </div>
        <div class="mb-4">
            <label for="deadline" class="block text-black">Deadline</label>
            <input type="date" name="deadline" class="w-full p-2 border border-white bg-gray-300 text-black">
        </div>
        <button type="submit" class="w-half  py-2 px-4 bg-blue-600 text-black rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Create</button>
    </form>
</x-app-layout>
