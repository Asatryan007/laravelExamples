<x-app-layout>
    <div class="container mx-auto px-5">
        <h2 class="text-white flex justify-center items-center text-2xl mb-4 mt-4">{{'Edit Task'}}</h2>

        @if(session('success'))
            <div class="mb-4 p-2 bg-green-600 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST"
              class="max-w-lg mx-auto p-6 bg-gray-500 rounded-lg">
            @csrf
            @method('PUT')
            @php
                $users = $task->users;
                $userTask = $task->users->firstWhere('id', auth()->id());
                $deadline = $userTask ? $userTask->pivot->deadline : 'non-privileged data';
            @endphp
            @if ($task->parent_id === auth()->id())
                <div class="mb-4">
                    <label for="title" class="block text-black">Title</label>
                    <input type="text" value="{{$task->title}}" name="title" required maxlength="255"
                           class="w-full p-2 border border-white bg-gray-300 text-black">
                    @error('title')
                    <div class="alert alert-danger text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="description" class="block text-black">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="w-full p-2 border border-white bg-gray-300 text-black">{{$task->description}}</textarea>
                    @error('description')
                    <div class="alert alert-danger text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="startedAt" class="block text-black">Choose the starting date.</label>
                    <input type="date" name="startedAt" value="{{$task->startedAt}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="startedAt" class="block text-black">Choose the completion date.</label>
                    <input type="date" name="completedAt" value="{{$task->completedAt}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="deadline" class="block text-black">Select the date for the deadline.</label>
                    <input type="date" name="deadline" value="{{$deadline}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black">
                </div>
                <div class="mb-4">
                    <label for="usersname">Users which have the same task</label>
                    <div id="usersname" class="flex flex-col h-40 p-4 overflow-y-auto">
                        @foreach($users as $user)
                            @if($task->parent_id != $user->pivot->user_id)
                                <div class="flex justify-between mb-4">
                                    <p>{{$user->name}}</p>
                                    <p>{{$user->email}}</p>

                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="mb-4">
                        <label for="users" class="block text-black">{{'Select Users'}}</label>

                        <select name="users[]" id="users"
                                class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500"
                                multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <button type="submit"
                                class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            {{'Update'}}
                        </button>
                        <button type="button"
                                class="bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">
                            <a href="{{ route('tasks.index') }}"> {{'Cancel'}} </a>
                        </button>
                    </div>
                </div>
        </form>
        @else
            <form action="{{ route('tasks.update', $task) }}" method="POST"
                  class="max-w-lg mx-auto p-6 bg-gray-500 rounded-lg">
                <div class="mb-4">
                    <label for="title" class="block text-black">Title</label>
                    <input type="text" value="{{$task->title}}" name="title" maxlength="255"
                           class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed" disabled>
                    <input type="hidden" value="{{$task->title}}" name="title" maxlength="255"
                           class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed">
                    @error('title')
                    <div class="alert alert-danger text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-8">
                    <label for="description" class="block text-black">Description</label>
                    <textarea name="description" cols="30" rows="10"
                              class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed"
                              disabled>{{$task->description}}</textarea>
                    <input type="hidden" value="{{$task->description}}" name="description" maxlength="255"
                           class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed">
                    @error('description')
                    <div class="alert alert-danger text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="startedAt" class="block text-black">Choose the starting date.</label>
                    <input type="date" name="startedAt" value="{{$task->startedAt}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="startedAt" class="block text-black">Choose the completion date.</label>
                    <input type="date" name="completedAt" value="{{$task->completedAt}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="deadline" class="block text-black">Select the date for the deadline.</label>
                    <input type="date" name="deadline" value="{{$deadline}}"
                           class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed" disabled>
                    <input type="hidden" value="{{$deadline}}" name="deadline" maxlength="255"
                           class="w-full p-2 border border-white bg-gray-300 text-black cursor-not-allowed">
                </div>

                <div class="">
                    <button type="submit"
                            class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        {{'Update'}}
                    </button>
                    <button type="button"
                            class="bg-gray-300 text-gray-700 rounded-lg px-4 py-2 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-opacity-50">
                        <a href="{{ route('tasks.index') }}"> {{'Cancel'}} </a>
                    </button>
                </div>
                @endif
            </form>
    </div>
</x-app-layout>
