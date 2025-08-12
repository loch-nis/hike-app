<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class CommonChecklistController extends Controller
{
    public function show(Hike $hike): JsonResponse
    {
        $commonChecklist = $hike->commonChecklist;

        $commonChecklistItems = $commonChecklist->commonChecklistItems;

        return response()->json([
            'checklist' => $commonChecklist->withoutRelations(),
            'data' => $commonChecklistItems,
        ]);

    }
}
