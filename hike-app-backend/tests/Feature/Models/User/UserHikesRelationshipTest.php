<?php

use App\Models\Hike;
use App\Models\HikeUser;
use App\Models\User;

it('can retrieve all hikes of which a user is a member', function (int $numberOfHikes) {
    $user = User::factory()->create();

    $hikes = Hike::factory()
        ->has(HikeUser::factory()->for($user))
        ->count($numberOfHikes)
        ->create();

    $hikeIds = $hikes->pluck('id')->sort()->values();
    $relationHikeIds = $user->hikes()->pluck('hikes.id')->sort()->values();

    expect($hikeIds)
        ->toEqual($relationHikeIds);

})
    ->with([1, 10, 100]);

it('can exclude hikes of which a user is not a member', function ($numberOfMemberHikes) {
    $numberOfNonMemberHikes = 50;
    $nonMemberHikes = Hike::factory()->count($numberOfNonMemberHikes)->create();

    $user = User::factory()->create();

    $memberHikes = Hike::factory()
        ->has(HikeUser::factory()->for($user))
        ->count($numberOfMemberHikes)
        ->create();

    $memberHikeIds = $memberHikes->pluck('id');
    $nonMemberHikeIds = $nonMemberHikes->pluck('id');
    $relationHikeIds = $user->hikes()->pluck('hikes.id');

    expect($relationHikeIds)
        ->intersect($memberHikeIds)
        ->toHaveCount($numberOfMemberHikes)
        ->and($relationHikeIds)
        ->intersect($nonMemberHikeIds)
        ->toBeEmpty();
})
    ->with([1, 10, 100]);
