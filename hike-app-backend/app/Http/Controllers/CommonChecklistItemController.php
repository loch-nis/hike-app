<?php

namespace App\Http\Controllers;

use App\Events\CommonChecklistUpdated;
use App\Http\Requests\CommonChecklistItemStoreRequest;
use App\Models\CommonChecklistItem;
use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class CommonChecklistItemController extends Controller
{
    public function store(CommonChecklistItemStoreRequest $request, Hike $hike): JsonResponse
    {
        $commonChecklist = $hike->commonChecklist;

        $commonChecklistItem = $commonChecklist->commonChecklistItems()->create([
            'content' => $request['content'],
        ]); // todo use the factory here? why or why not?!

        // todo for all three: add ->toOthers() ?? and test
        CommonChecklistUpdated::broadcast($commonChecklist->getKey());

        return response()->json($commonChecklistItem);
    }

    public function update(CommonChecklistItem $commonChecklistItem): JsonResponse
    {
        $commonChecklistItem->toggleIsChecked();

        $commonChecklistItem->checked_at = now();

        $commonChecklist = $commonChecklistItem->commonChecklist;

        $hikeUser = auth()->user()->hikeUsers()->where('hike_id',
            $commonChecklist->hike->id)->first();

        $commonChecklistItem->checked_by = $hikeUser->id;
        $commonChecklistItem->save();

        CommonChecklistUpdated::broadcast($commonChecklist->getKey());

        return response()->json($commonChecklistItem);
    }

    public function destroy(CommonChecklistItem $commonChecklistItem): JsonResponse
    {
        $commonChecklistItem->delete();

        CommonChecklistUpdated::broadcast($commonChecklistItem->commonChecklist->getKey());

        return response()->json($commonChecklistItem);
    }
}
