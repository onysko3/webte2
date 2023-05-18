<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Set;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_teacher) {
            return redirect()->route('teacher.home');
        }elseif (!auth()->user()->is_teacher){
            return redirect()->route('student.home');
        }
        else {
            return view('home');
        }
    }

    public function adminHome(){
        $sets = Set::all();

    return view('admin-home', compact('sets'));
    }
}

