<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalChecklistItemStoreRequest;
use App\Models\Hike;
use App\Models\PersonalChecklistItem;
use Illuminate\Http\JsonResponse;

class PersonalChecklistItemController extends Controller
{
    public function store(PersonalChecklistItemStoreRequest $request, Hike $hike): JsonResponse
    {
        $personalChecklist = $hike->personalChecklistFor(auth()->user());
        $personalChecklistItem = $personalChecklist->personalChecklistItems()->create([
            'content' => $request->validated('content'),
        ]);

        // todo investigate eager loading and whether this is a good use case for it?

        return response()->json($personalChecklistItem, 201);
    }

    public function update(PersonalChecklistItem $personalChecklistItem): JsonResponse
    {
        $personalChecklistItem->toggleIsChecked();

        $personalChecklistItem->checked_at = now();

        $personalChecklistItem->save();

        return response()->json($personalChecklistItem);
    }

    public function destroy(PersonalChecklistItem $personalChecklistItem): JsonResponse
    {
        // Route model binding. Throws 404 if not found automatically before this
        // reminder-quiz: how does laravel infer model binding? hint: its in this file :))
        $personalChecklistItem->delete();

        return response()->json($personalChecklistItem);
    }
}
