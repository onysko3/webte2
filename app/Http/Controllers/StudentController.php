<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function getTaskByStudent(Request $request)
    {
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        //$user = User::find(1);
        //$tasks = $user->tasks;
        $task = Task::find(11);
        return view('student/editor', ['task' => $task]);
    }

    public function getTask(Request $request){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $task  = Task::find(1);
        return view('student/editor', ['task'=>$task]);
    }
}
