<?php
namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use PDF;

class TeacherInstructionController extends Controller
{
    public function index()
    {
        return view('teacher_instruction.index');
    }
}
