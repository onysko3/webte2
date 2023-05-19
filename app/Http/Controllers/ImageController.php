<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $request->file->getClientOriginalName();

        // Save the image in the public/images directory
        $request->file->storeAs('public/images', $imageName);

        // Check if the image was stored successfully
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('images/' . $imageName)) {
            // If it was not stored, redirect back with an error message
            return redirect()->back()->with('error', 'There was a problem storing the image.');
        }

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
