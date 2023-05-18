<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use App\Models\Task;


class LaTeXController extends Controller
{
    function parseLaTeXFile($filePath, $setId)
    {
        $latexContent = file_get_contents($filePath);


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
            $imgPattern = '/\\\\includegraphics\\{zadanie99(.*?)\\}/s';
            preg_match($imgPattern, $taskContent, $imgMatch);
            $imagePath = isset($imgMatch[1]) ? '/images' . $imgMatch[1] : '';


            // Append the equation to the task description if it exists
            if ($equation !== '') {
                $taskDescription .= ' $' . $equation . '$';
            }

            $tasks[] = [
                'task_code' => $taskCode,
                'task_description' => $taskDescription,
                'image_path' => $imagePath,
                'solution_equation' => $match[3],
            ];
            $taskdata = [
                'set_id' => $setId,
                'task_name' => $taskCode,
                'assignment' => $taskDescription,
                'img_name' => $imagePath,
                'results' => $match[3],
            ];
            Task::create($taskdata);
        }

        return $tasks;
    }


    public function showParsedData(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:tex|max:2048'
        ]);

        $fileName = $request->file->getClientOriginalName();

        // First create the set and get its ID
        $set = Set::firstOrNew(['file_name' => $fileName]);

        // Check if the set already exists in the database
        if ($set->exists) {
            // If it does, redirect back with an error message
            return redirect()->back()->with('error', 'A set with that file name already exists.');
        }
        $set->save();

        $setId = $set->id;

        $fileTempPath = $request->file->getRealPath();

        // Now parse the LaTeX file with the ID
        $this->parseLaTeXFile($fileTempPath, $setId);
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
}
