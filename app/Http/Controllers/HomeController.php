<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){ //passing data to home(index) page
        return view('home', ['title' => 'Home Page example', //passing title
            'content'=> 'This content from controller']); //passing content
    }
}
