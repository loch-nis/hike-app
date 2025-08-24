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
        // wrap all of this in a DB::transaction() for exception handling and auto rollback?

        $hike = Hike::query()->create([
            'title' => $request->validated('title'),
        ]);

        $hikeOwner = $hike->hikeUsers()->create([
            'role' => 'owner',
            'user_id' => auth()->id(),
            'joined_at' => now(),
        ]);

        $hike->commonChecklist()->create();

        $hikeOwner->personalChecklist()->create();

        return response()->json($hike, 201); // consider returning a location header?
    }

    public function show(Hike $hike): JsonResponse
    {
        return response()->json($hike);
    }

    public function join(Hike $hike)
    {
        // investigate best practice naming for this controller method
    }
}
