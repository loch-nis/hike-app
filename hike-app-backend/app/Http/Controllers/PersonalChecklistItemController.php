<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use App\Models\PersonalChecklistItem;
use Illuminate\Http\JsonResponse;

class PersonalChecklistItemController extends Controller
{
    public function store(Hike $hike): JsonResponse
    {
        // todo validate

        // todo refactor into either model or service logic -> find out which is best when?!?!
        $hikeUser = auth()->user()->hikeUsers()->where('hike_id', $hike->id)->firstOrFail();
        $checklist = $hikeUser->personalChecklist()->firstOrFail();
        $item = $checklist->personalChecklistItems()->create([
            'content' => request('content')
        ]);
        // todo investigate eager loading

        return response()->json($item, 201);
    }

    public function update(PersonalChecklistItem $item): JsonResponse
    {
        $item->is_checked = !$item->is_checked;

        $item->checked_at = now();

        $item->save();

        return response()->json($item, 200);
    }

    public function destroy(PersonalChecklistItem $item): JsonResponse
    {
        // Route model binding. Throws 404 if not found automatically before this
        $item->delete();

        return response()->json($item, 200);
    }
    // todo learn how to write some tests - TDD try out??
}
