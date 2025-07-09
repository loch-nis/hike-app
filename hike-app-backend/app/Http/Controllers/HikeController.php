<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\Request;

class HikeController extends Controller
{
    public function index()
    {
        $hikes = auth()->user()->hikes()->get();

        return response()->json($hikes, 200);
    }

    public function store(Request $request)
    {
        $hike = Hike::create([
            'title' => $request['title'],
        ]);

        $hikeUser = $hike->hikeUsers()->create([
            'hike_id' => $hike->id,
            'user_id' => auth()->id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        $hike->commonChecklist()->create();

        $hikeUser->personalChecklists()->create([
            'hike_user_id' => $hikeUser->id,
        ]);

        return response()->json($hike->load('commonChecklist'), 201);
    }

    public function join(Request $request)
    {
        // naming?!?!?
    }

    public function show(string $id)
    {
        return Hike::findOrFail($id);
    }

    public function update(string $id) {}

    public function destroy(string $id) {}
}
