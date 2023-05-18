<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class SetController extends Controller
{
    public function update(Request $request, Set $set)
    {
        $set->points = $request->input('points');
        $set->available_to_generate = $request->has('available_to_generate') ? 1 : 0;
        $set->available_to = $request->input('available_to');

        $set->save();


        return redirect()->back()->with('success', 'Set points updated successfully.');
    }

}
