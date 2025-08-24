<?php

use App\Models\User;

it('allows a user to retrieve all its hikes', function () {
    $hike = setupHikeWithItems();

    $user = $hike->users()->first();

    $response = authGetJson($user, route('hikes'))
        ->assertOk();

    expect($response->content())
        ->toContain($hike->id)
        ->toContain($hike->title);
});

it('allows a member of the hike to retrieve it', function () {
    $hike = setupHikeWithItems();

    $user = $hike->users()->first();

    $response = authGetJson($user, route('hikes.show', $hike->id))
        ->assertOk();

    expect($response->content())
        ->toContain($hike);
});

it('forbids a non-member of the hike from retrieving it', function () {
    $hike = setupHikeWithItems();

    $nonMemberOfHike = User::factory()->create();

    authGetJson($nonMemberOfHike, route('hikes.show', $hike->id))
        ->assertForbidden();
});
