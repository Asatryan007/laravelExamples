<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreateValidateRequest;
use App\Http\Requests\StoreUpdateValidateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $filters = [
            'status' => $request->input('status', 'all'),
        ];

        $tasks = $this->filterTasks($filters);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    //function store get request check for validate and return data
    public function store(StoreCreateValidateRequest $request): RedirectResponse
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
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
        $task->update($request->validated());

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function filterTasks(array $filters)
    {
        $tasksQuery = Task::query();

        // Filter by status
        if ($filters['status'] !== 'all') {
            $tasksQuery->where('status', $filters['status']);
        }

        return $tasksQuery->paginate(20);
    }
}
