<?php

use App\Models\User;

use function Pest\Laravel\postJson;

it('can register a new user', function () {
    $registration = [
        'email' => 'valid@email.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ];

    postJson(route('register', $registration))
        ->assertCreated();

    expect(User::all())->toHaveCount(1);
});

it('rejects user registration with invalid email', function () {
    $registrationAttempt = [
        'email' => 'invalidEmail@.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ];

    postJson(route('register'), $registrationAttempt)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('rejects user registration with duplicate email', function () {
    $email = 'valid@email.com';

    User::factory()->create([
        'email' => $email,
    ]);

    $registrationAttemptWithExistingEmail = [
        'email' => $email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ];

    postJson(route('register'), $registrationAttemptWithExistingEmail)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('email');
});

it('rejects user registration without password confirmation', function () {
    $registrationAttempt = [
        'email' => 'valid@email.com',
        'password' => 'password',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ];

    postJson(route('register'), $registrationAttempt)
        ->assertUnprocessable()
        ->assertJsonValidationErrors('password');
});
