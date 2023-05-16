<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserTask;

class TeacherController extends Controller
{
    public function students()
{
    $students = DB::table('users AS u')
        ->leftJoin('user_task AS ut', 'u.id', '=', 'ut.user_id')
        ->where('u.is_teacher', 0)
        ->select('u.name',
            DB::raw('COUNT(ut.generated_at) AS total_generated'),
            DB::raw('SUM(CASE WHEN ut.result IS NOT NULL THEN 1 ELSE 0 END) AS total_submitted'),
            DB::raw('SUM(CASE WHEN ut.result IS NOT NULL THEN ut.points ELSE 0 END) AS total_points'),)
        ->groupBy('u.id', 'u.name')
        ->get();

    return view('teacher.students', ['students' => $students]);
}

public function tasks()
{
    $tasks = UserTask::select(
            'user_task.id',
            'users.name as student_name',
            'user_task.set_id',
            'user_task.task_number',
            'user_task.result',
            DB::raw('IF(user_task.result IS NOT NULL, "Yes", "No") as submitted'),
            'user_task.points',
            DB::raw('IF(user_task.result IS NULL OR (user_task.result IS NOT NULL AND user_task.points = 0), "Incorrect", "Correct") as task_status'),
        )
        ->leftJoin('users', 'users.id', '=', 'user_task.user_id')
        ->get();

    return view('teacher.tasks', ['tasks' => $tasks]);
}
}
