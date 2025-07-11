<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\JsonResponse;

class HikeController extends Controller
{
    public function index()
    {
        $hikes = auth()->user()->hikes()->latest()->get();

        return response()->json($hikes, 200);
    }

    public function store()
    {
        $hike = Hike::create([
            'title' => request('title'),
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
        // todo this should be implicit, so best practice to leave it out??
        return response()->json($hike, 200);
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
