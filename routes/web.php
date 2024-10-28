<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('tasks/filter', [TaskController::class, 'filterStatus'])->name('tasks.filter');

Route::resource('tasks', TaskController::class);
