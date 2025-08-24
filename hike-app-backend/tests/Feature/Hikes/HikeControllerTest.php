<?php

use App\Models\CommonChecklist;
use App\Models\Hike;
use App\Models\PersonalChecklist;
use App\Models\User;

it('can store a hike', function () {
    $user = User::factory()->create();

    $payload = ['title' => 'Test Hike'];

    authPostJson($user, route('hikes.store'), $payload)
        ->assertCreated();

    expect(Hike::query()->first()->title)->toBe('Test Hike')
        ->and($user->hikes()->first()->title)->toBe('Test Hike')
        ->and(PersonalChecklist::all()->count())->toBe(1)
        ->and(CommonChecklist::all()->count())->toBe(1);
});
