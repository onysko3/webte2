<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserTask;
use App\Models\Tasks_Student;

class TeacherController extends Controller
{
    public function students()
{
    $students = DB::table('users AS u')
        ->leftJoin('tasks_student AS ut', 'u.id', '=', 'student_id')
        ->where('u.is_teacher', 0)
        ->select('u.name',
            DB::raw('COUNT(ut.generated_at) AS total_generated'),
            DB::raw('SUM(CASE WHEN ut.submitted_result IS NOT NULL THEN 1 ELSE 0 END) AS total_submitted'),
            DB::raw('SUM(CASE WHEN ut.submitted_result IS NOT NULL THEN ut.point_obtained ELSE 0 END) AS total_points'),)
        ->groupBy('u.id', 'u.name')
        ->get();

    return view('teacher.students', ['students' => $students]);
}

public function tasks()
{
    $tasks = Tasks_Student::with('task')
        ->get();

    return view('teacher.tasks', ['tasks' => $tasks]);
}
}
