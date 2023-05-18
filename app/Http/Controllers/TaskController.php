<?php

namespace App\Http\Controllers;

use App\Models\UserTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $userTasks = UserTask::with('user')->get();

        return view('teacher.tasks', compact('userTasks'));
    }
}
