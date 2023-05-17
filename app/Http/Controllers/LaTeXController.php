<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaTeXController extends Controller
{
    function parseLaTeXFile($filePath)
{
    // Read the content of the LaTeX file
    $latexContent = file_get_contents($filePath);

    // Replace all "\" with "\\"
    $latexContent = str_replace('\\', '\\\\', $latexContent);

    // Extract the task and equation using a regex pattern
    $pattern = '/\\\\section\\*\\{([A-Z0-9]+)\\}.*?\\\\begin\\{task\\}(.*?)\\\\includegraphics\\{(.*?)\\}.*?\\\\begin\\{equation\\*\\}(.*?)\\\\end\\{equation\\*\\}/s';
    preg_match_all($pattern, $latexContent, $matches, PREG_SET_ORDER);

    // Save the extracted tasks and equations in an array
    $tasks = [];
    foreach ($matches as $match) {
        $taskCode = $match[1];
        $taskDescription = $match[2];
        $imagePath = $match[3];
        $equation = $match[4];
    
        $tasks[] = [
            'task_code' => $taskCode,
            'task_description' => $taskDescription,
            'image_path' => $imagePath,
            'equation' => $equation,
        ];
    }

    return $tasks;
}
public function showParsedData()
{
    $filePath = public_path('files/blokovka01pr.tex');
    $tasks = $this->parseLaTeXFile($filePath);

    return view('parsed_data', ['tasks' => $tasks]);
}
}
