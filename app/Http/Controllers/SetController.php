<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class SetController extends Controller
{
    public function update(Request $request, Set $set)
    {
        $set->update($request->only('points'));

        return redirect()->back()->with('success', 'Set points updated successfully.');
    }

}
