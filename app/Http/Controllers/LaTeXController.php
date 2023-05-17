<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;


class LaTeXController extends Controller
{
    function parseLaTeXFile($filePath)
{
    // Read the content of the LaTeX file
    $latexContent = file_get_contents($filePath);

    // Extract the task, equation, image, and solution using a regex pattern
    $pattern = '/\\\\section\\*\\{([A-Z0-9]+)\\}.*?\\\\begin\\{task\\}(.*?)\\\\end\\{task\\}.*?\\\\begin\\{solution\\}(?:.*?\\\\begin\\{equation\\*\\}(.*?)\\\\end\\{equation\\*\\})/s';
    preg_match_all($pattern, $latexContent, $matches, PREG_SET_ORDER);

    // Save the extracted tasks, equations, images, and solutions in an array
    $tasks = [];
    foreach ($matches as $match) {
        $taskCode = $match[1];
        $taskContent = trim($match[2]);

        // Extract the task description
        $descPattern = '/^(.*?)(?:\\\\begin\\{equation\\*\\}|\\\\includegraphics)/s';
        preg_match($descPattern, $taskContent, $descMatch);
        $taskDescription = trim($descMatch[1]);

        // Extract the equation
        $eqPattern = '/\\\\begin\\{equation\\*\\}(.*?)\\\\end\\{equation\\*\\}/s';
        preg_match($eqPattern, $taskContent, $eqMatch);
        $equation = isset($eqMatch[1]) ? trim($eqMatch[1]) : '';

        // Extract the image path
        $imgPattern = '/\\\\includegraphics\\{(.*?)\\}/s';
        preg_match($imgPattern, $taskContent, $imgMatch);
        $imagePath = isset($imgMatch[1]) ? $imgMatch[1] : '';

        // Append the equation to the task description if it exists
        if ($equation !== '') {
            $taskDescription .= ' ' . $equation;
        }

        $tasks[] = [
            'task_code' => $taskCode,
            'task_description' => $taskDescription,
            'image_path' => $imagePath,
            'solution_equation' => $match[3],
        ];
    }

    return $tasks;
}


    public function showParsedData()
    {
        $folderPath = public_path('files');
        $filePaths = glob($folderPath . '/*.tex');

        $tasks = [];

        foreach ($filePaths as $filePath) {
            $fileName = basename($filePath);
        $setData = [
            'file_name' => $fileName,
            'available_to_generate' => true, // Set this value as needed
            'points' => 0, // Set this value as needed
            'available_from' => now(), // Set this value as needed
            'available-to' => now()->addDays(30), // Set this value as needed
        ];
        Set::create($setData);
            $fileTasks = $this->parseLaTeXFile($filePath);

            $tasks = array_merge($tasks, $fileTasks);
        }

        return view('parsed_data', ['tasks' => $tasks]);
    }
}