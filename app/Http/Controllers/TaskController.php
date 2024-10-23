<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Tasks::all(); //Get all datas
        return view('tasks.index', compact('tasks'));
    }

    //Create function
    public function create(){
        return view('tasks.create');
    }

    //function store get request check for validate and return data
    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'startedAt' => 'nullable|date',
            'completedAt' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);
        Tasks::create($validatedData);//create new task
        //redirect in index page where are present list of tasks and create session with 'with()'
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    public function show(Tasks $task){
        return view('tasks.show', compact('task'));
    }

    public function edit(Tasks $task){
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Tasks $task){

           $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'startedAt' => 'date|nullable',
                'completedAt' => 'date|nullable',
                'deadline' => 'date|nullable',
                'status'=>  'boolean',
            ]);
            $task->update($validatedData);
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    public function destroy(Tasks $task){
      $task->delete();
      return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
