<?php

use App\Models\User;

use function Pest\Laravel\withHeaders;

test('a user can view all its hikes and has at least one', function () {
    $response = withHeaders($this->authHeader)->getJson('/api/hikes');

    $hike = $response[0];

    expect($hike['id'])->toBeUuid()
        ->and($hike['id'])->toBe($this->hikeId)
        ->and($hike['title'])->toBeCountry();
})->todo();

test('a user can view its own hike', function () {
    $response = withHeaders($this->authHeader)->getJson('/api/hikes/'.$this->hikeId)
        ->assertOk();
    expect($response['id'])->toBeUuid()
        ->and($response['title'])->toBeCountry();

})->todo();

it('forbids an outsider from viewing a hike', function () {
    $hike = setupHikeWithItems();

    $outsider = User::factory()->create();

    authGetJson($outsider, route('hikes.show', $hike->id))
        ->assertForbidden();
});

// naming:  non-member of the hike vs member of the hike!!! most readable
