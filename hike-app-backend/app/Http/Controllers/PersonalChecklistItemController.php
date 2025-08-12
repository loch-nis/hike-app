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
        // todo USE and TEST the validation

        // todo refactor into either model or service logic -> find out which is best when?!?!
        $hikeUser = auth()->user()->hikeUsers()->where('hike_id', $hike->id)->firstOrFail();
        $checklist = $hikeUser->personalChecklist()->firstOrFail();
        $item = $checklist->personalChecklistItems()->create([
            'content' => $request['content'],
        ]);
        // todo investigate eager loading

        return response()->json($item, 201);
    }

    public function update(PersonalChecklistItem $personalChecklistItem): JsonResponse
    {
        $personalChecklistItem->is_checked = ! $personalChecklistItem->is_checked;

        $personalChecklistItem->checked_at = now();

        $personalChecklistItem->save();

        return response()->json($personalChecklistItem);
    }

    public function destroy(PersonalChecklistItem $personalChecklistItem): JsonResponse
    {
        // Route model binding. Throws 404 if not found automatically before this
        // how does laravel infer model binding? hint its in this file :))
        $personalChecklistItem->delete();

        return response()->json($personalChecklistItem);
    }
}
