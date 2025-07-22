<?php

namespace App\Http\Controllers;

use App\Events\CommonChecklistUpdated;
use App\Models\CommonChecklistItem;
use App\Models\Hike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommonChecklistItemController extends Controller
{
    public function store(Request $request, Hike $hike): JsonResponse
    {
        $checklist = $hike->commonChecklist;

        $item = $checklist->commonChecklistItems()->create([
            'content' => $request['content']
        ]);

        // todo for all three: add ->toOthers() ?? and test
        CommonChecklistUpdated::broadcast($checklist->id);

        return response()->json($item);
    }

    public function update(CommonChecklistItem $item): JsonResponse
    {
        $item->is_checked = !$item->is_checked;

        $item->checked_at = now();

        $checklist = $item->checklist;

        $hike = $checklist->hike;

        $hikeUser = auth()->user()->hikeUsers()->where('hike_id',
            $hike->id)->first();

        $item->checked_by = $hikeUser->id;

        $item->save();

        CommonChecklistUpdated::broadcast($checklist->id);

        return response()->json($item);
    }

    public function destroy(CommonChecklistItem $item): JsonResponse
    {
        $item->delete();

        CommonChecklistUpdated::broadcast($item->checklist->id);

        return response()->json($item);
    }
}
