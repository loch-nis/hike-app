<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class CommonChecklistController extends Controller
{
    public function show(Hike $hike): JsonResponse
    {
        // todo make sure that people not members of the hike can't access it. Watch Laracasts authorization episodes?? I think I need to use policies! Not gates
        // todo ACTUALLY middleware - probably make:middleware - and then use policies in that perhaps?!?!
        $commonChecklist = $hike->commonChecklist;

        $commonChecklistItems = $commonChecklist->commonChecklistItems;

        return response()->json([
            'checklist' => $commonChecklist->withoutRelations(),
            'data' => $commonChecklistItems,
        ]);

    }
}
