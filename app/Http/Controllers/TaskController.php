<?php

namespace App\Http\Controllers;

class TaskController extends Controller
{

    public function show()
    {    
        return view('tasks.index');
    }

    public function store()
    {
        return view('tasks.create');
    }
}
