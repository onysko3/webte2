<?php

namespace App\Http\Controllers;


use App\Models\TaskModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getTask(Request $request){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $task  = TaskModel::find(4);
        return view('student/editor', ['task'=>$task]);
    }
}
