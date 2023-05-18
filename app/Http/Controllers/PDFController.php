<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function generate()
    {
        $dompdf = new Dompdf();
        $html = View::make('instructions')->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('instructions.pdf');
}
}
