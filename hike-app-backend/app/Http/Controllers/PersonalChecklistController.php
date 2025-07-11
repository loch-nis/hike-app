<?php

namespace App\Http\Controllers;

use App\Models\Hike;

// todo validation for everything, but perhaps spatie or something lib is the way to avoid thousands of FormRequests?

class PersonalChecklistController extends Controller
{
    public function show(Hike $hike)
    {
        $hikeUser = auth()->user()->hikeUsers()->where('hike_id',
            $hike->id)->first();

        $items = $hikeUser->personalChecklist->personalChecklistItems;
        return response()->json(['data' => $items], 200); // todo fix magic string?
    }

}
