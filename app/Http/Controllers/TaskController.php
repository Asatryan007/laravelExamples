<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreateValidateRequest;
use App\Http\Requests\StoreUpdateValidateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all(); //Get all datas
        return view('tasks.index', compact('tasks'));
    }

    //Create function
    public function create(){
        return view('tasks.create');
    }

    //function store get request check for validate and return data
    public function store(StoreCreateValidateRequest $request){
        Task::create($request->validated());//create new task
        //redirect in index page where are present list of tasks and create session with 'with()'
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    public function show(Task $task){
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task){
        return view('tasks.edit', compact('task'));
    }
    public function update(StoreUpdateValidateRequest $request, Task $task){

            $task->update($request->validated());
            return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully.');
    }
    public function destroy(Task $task){
      $task->delete();
      return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
