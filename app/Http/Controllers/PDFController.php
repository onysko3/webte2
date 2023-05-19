<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
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
        $o = new Options(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $dompdf->setOptions($o);
        $dompdf->stream('instructions.pdf');
}
}
