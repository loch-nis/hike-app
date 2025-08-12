<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class PersonalChecklistController extends Controller
{
    public function show(Hike $hike): JsonResponse
    {
        $hikeUser = auth()->user()->hikeUsers()->where('hike_id',
            $hike->id)->firstOrFail();

        $items = $hikeUser->personalChecklist->personalChecklistItems;

        return response()->json(['data' => $items]); // todo fix magic string?
    }
}
