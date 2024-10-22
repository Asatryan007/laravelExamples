<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route for dynamic home page
Route::get('/home',[HomeController::class,'index'])->name('home');

//Route for static  about task 2 page
Route::get('/about_task2',function(){
    return view('about_task2');
});
