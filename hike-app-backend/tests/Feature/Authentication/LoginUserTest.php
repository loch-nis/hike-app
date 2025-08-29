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

it('rejects a login attempt from a user who is already logged in')->todo();
