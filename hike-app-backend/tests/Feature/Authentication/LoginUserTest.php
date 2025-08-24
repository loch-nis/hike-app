<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('logs in a user with valid credentials', function () {
    $email = 'example@email.com';
    $password = 'examplePassword';

    User::factory()->create([
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $validCredentials = [
        'email' => $email,
        'password' => $password,
    ];

    $response = postJson(route('login'), $validCredentials);

    $response->assertOk();
    expect($response['access_token'])->toBeString();
});

it('rejects invalid credentials', function () {
    $email = 'example@email.com';
    $password = 'examplePassword';

    $invalidCredentials = [
        'email' => $email,
        'password' => $password,
    ];

    postJson(route('login'), $invalidCredentials)
        ->assertUnauthorized();
});

// todo describe(guest) and describe(auth) or just another test trying to log in when already auth. or wait is there any reason to test that here? maybe its a frontend thing.
