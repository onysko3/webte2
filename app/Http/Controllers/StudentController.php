<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;

use App\Models\TaskModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function getTaskByStudent(Request $request){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $user  = User::find(1);
        $tasks = $user->tasks;
        return view('student/editor', ['user'=>$user, 'tasks'=>$tasks]);
      
    public function getTask(Request $request){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $task  = TaskModel::find(4);
        return view('student/editor', ['task'=>$task]);
    }
}
