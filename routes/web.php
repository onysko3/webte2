<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/teacher/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('teacher.home')->middleware('is_teacher');

Route::get('/teacher/students', [App\Http\Controllers\TeacherController::class, 'students'])->name('teacher.students')->middleware('is_teacher');

Route::get('/teacher/tasks', [App\Http\Controllers\TeacherController::class, 'tasks'])->name('teacher.tasks')->middleware('is_teacher');