<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
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


Route::get('/editor', [StudentController::class, 'getTaskByStudent']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/teacher/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('teacher.home')->middleware('is_teacher');

Route::get('/teacher/students', [App\Http\Controllers\TeacherController::class, 'students'])->name('teacher.students')->middleware('is_teacher');

Route::get('/teacher/tasks', [App\Http\Controllers\TeacherController::class, 'tasks'])->name('teacher.tasks')->middleware('is_teacher');

Route::get('instructions', 'App\Http\Controllers\InstructionController@show')->name('instructions');

Route::post('view-pdf', 'App\Http\Controllers\PDFController@generate')->name('view-pdf');

Route::put('/sets/{set}', 'App\Http\Controllers\SetController@update')->name('sets.update')->middleware('is_teacher');
