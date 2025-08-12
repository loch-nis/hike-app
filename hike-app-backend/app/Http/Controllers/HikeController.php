<?php

namespace App\Http\Controllers;

use App\Http\Requests\HikeStoreRequest;
use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class HikeController extends Controller
{
    public function index(): JsonResponse
    {
        $hikes = auth()->user()->hikes()->latest()->get();

        return response()->json($hikes);
    }

    public function store(HikeStoreRequest $request): JsonResponse
    {
        // todo use Hike::factory()->create([xx]) here instead? or what is the difference?
        $hike = Hike::create([
            'title' => $request['title'],
        ]);

        // todo test if any of this is done auto
        $hikeUser = $hike->hikeUsers()->create([
            'hike_id' => $hike->id,
            'user_id' => auth()->id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        // todo do I need to set the hike_id here? or done auto??
        // its auto!
        $hike->commonChecklist()->create();

        // so also don't need to set hike id here!
        $hikeUser->personalChecklist()->create();

        return response()->json($hike, 201);
    }

    public function show(Hike $hike): JsonResponse
    {
        return response()->json($hike);
    }

    public function join(Hike $hike)
    {
        // naming?!?!?
    }

    public function update(string $id)
    {
        // todo route model binding here and below
    }

    public function destroy(string $id)
    {
        // todo
    }
}
