<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getTaskByStudent(Request $request){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $user  = User::find(1);
        $tasks = $user->tasks;
        return view('student/editor', ['user'=>$user, 'tasks'=>$tasks]);
    }
}
