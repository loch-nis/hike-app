<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class PersonalChecklistController extends Controller
{
    public function show(Hike $hike): JsonResponse
    {
        $personalChecklist = $hike->personalChecklistFor(auth()->user());

        return response()->json(['data' => $personalChecklist->personalChecklistItems]);
    }
}
