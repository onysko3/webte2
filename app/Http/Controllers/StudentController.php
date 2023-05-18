<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\Set;
use App\Models\Task;
use App\Models\Tasks_Student;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function home(Request $request){
        $actualDateTime = date('Y-m-d H:i:s');
        $query = "select * from sets
                    WHERE available_to_generate = 1
                    AND ((available_from <= :dateTime AND available_to >= :dateTime1)
                        OR (available_from <= :dateTime2 AND available_to IS NULL)
                        OR (available_from IS NULL AND available_to >= :dateTime3)
                        OR (available_from IS NULL AND available_to IS NULL)
                    );";
        $sets = DB::select($query, ['dateTime'=>$actualDateTime, 'dateTime1'=>$actualDateTime, 'dateTime2'=>$actualDateTime, 'dateTime3'=>$actualDateTime]);

        $queryGenTasks = "SELECT tasks_student.id, sets.file_name, tasks.task_name, tasks_student.generated_at, tasks_student.submitted_at
                            FROM sets, tasks, tasks_student
                            WHERE tasks_student.student_id = :student
                            AND tasks.id = tasks_student.task_id
                            AND sets.id = tasks.set_id;";

        $generatedTasks = DB::select($queryGenTasks, ['student'=>auth()->user()->id]);

        return view('/student/student-home')
            ->with('sets', $sets)
            ->with('overview', $generatedTasks);
    }

    public function generateTasks(Request $request){
        $selectedSets = $request->input('sets');
        for ($i = 0; $i<count($selectedSets); $i++){
            $points = Set::find($selectedSets[$i])->points;
            $tasks = Set::find($selectedSets[$i])->tasks;
            $number_tasks = count($tasks);
            $randIndex = rand(0, $number_tasks-1);
            $randTask = $tasks[$randIndex];
            $task_student = new Tasks_Student;
            $task_student->task_id = $randTask->id;
            $task_student->student_id = auth()->user()->id;
            $actualDateTime = date('Y-m-d H:i:s');
            $task_student->generated_at = $actualDateTime;
            $task_student->point_obtained = $points;
            $task_student->save();
        }

        return redirect('home');

    }

    public function getTaskByStudent(Request $request, $id)
    {
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        //$user = User::find(1);
        //$tasks = $user->tasks;
        $task_student = Tasks_Student::find($id);
        if ($task_student->student_id !== auth()->user()->id){
            return redirect('home');
        }
        $task = $task_student->task;
        return view('/student/editor')
                ->with('task', $task)
                ->with('id', $id);
    }

    public function insertResult(Request $request, $id){
        //TODO z requestu vytiahnuť ktora uloha sa zobrazi

        $task  = Tasks_Student::find($id);
        $task->submitted_at = date('Y-m-d H:i:s');
        $task->submitted_result = $request->input('submitted_result');
        $task->is_result_correct = $request->input('is_result_correct');
        if (!$request->input('is_result_correct')){
            $task->point_obtained = 0;
        }
        $task->save();
        return redirect('home');
    }
}
