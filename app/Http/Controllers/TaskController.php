<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusUpdateRequest;
use App\Http\Requests\StoreCreateValidateRequest;
use App\Http\Requests\StoreUpdateValidateRequest;
use App\Mail\NotifyAboutTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $filters = [
            'status' => $request->input('status', null),
        ];
        $tasks = $this->filterTasks($filters);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('tasks.create', compact('users'));
    }

    //function store get request check for validate and return data
    public function store(StoreCreateValidateRequest $request): RedirectResponse
    {
        $taskData = $request->validated();

        $taskData['parent_id'] = Auth::id();
        $selectedUsers = $taskData['users'];

        $task = Task::create($taskData);

        auth()->user()->tasks()->attach($task->id, [
            'deadline' => $taskData['deadline'] ?? null,
        ]);

        $task->users()->attach($selectedUsers);


        $details = [
            'title' => $taskData['title'],
            'message' => 'You have been added to task ' . $taskData['title'],
        ];

        $this->notifyAboutTask($details, $selectedUsers);

        return redirect()->route('tasks.index')->with('success', __('Task created successfully.'));
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {

        return view('tasks.edit', compact('task'));
    }

    public function update(StoreUpdateValidateRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();
        $deadline = $data['deadline'];

        $task->update(collect($data)->except('deadline')->toArray());

        auth()->user()->tasks()->updateExistingPivot($task->id, [
            'deadline' => $deadline,
        ]);

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function detach( $userId, $taskId): RedirectResponse
    {

        $user = User::findOrFail($userId);

        $user->tasks()->detach($taskId);

        return redirect()->route('tasks.edit', $taskId)->with('success', 'Task from User deleted successfully.');
    }

    public function statusUpdate(StatusUpdateRequest $request, Task $task): RedirectResponse
    {
        $status = $request->validated()['status'];

        auth()->user()->tasks()->updateExistingPivot($task->id, [
            'status' => $status,
        ]);

        return redirect()->route('tasks.show',$task)->with('success','Task  '. $task->title .'  status updated successfully.');
    }

    private function filterTasks(array $filters)
    {
        $tasksQuery = Task::with('users:id,name'); // Eager load users with status

        $tasksQuery->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        });

        // Filter by status
        if (!is_null($filters['status']) && $filters['status'] !== 'all') {
            $tasksQuery->whereHas('users', function ($query) use ($filters) {
                $query->where('user_id', auth()->id())
                    ->where('status', $filters['status']);
            });
        }

        return $tasksQuery->paginate(20);
    }

    private function notifyAboutTask($details, $userIds)
    {
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotifyAboutTask($details));
        }
        return true;

    }

}
