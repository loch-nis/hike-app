<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use App\Models\CommonChecklist;
use App\Models\CommonChecklistItem;
use App\Models\Hike;
use App\Models\HikeUser;
use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\Helpers\CountryList;

use function Pest\Laravel\postJson;
use function Pest\Laravel\withHeaders;

pest()->extend(Tests\TestCase::class)
    // ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeCountry', function () {
    return $this->toBeIn(CountryList::FAKER_COUNTRIES);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * Visit the given URI with a GET request with an authorization header, expecting a JSON response.
 */
function authGetJson(User $user, $uri): TestResponse
{
    return withHeaders(getAuthHeader($user))
        ->getJson($uri);
}

function authPostJson(User $user, $uri, array $data = []): TestResponse
{
    return withHeaders(getAuthHeader($user))
        ->postJson($uri, $data);
}

function authPatchJson(User $user, $uri, array $data = []): TestResponse
{
    return withHeaders(getAuthHeader($user))
        ->patchJson($uri, $data);
}

function authDeleteJson(User $user, $uri): TestResponse
{
    return withHeaders(getAuthHeader($user))
        ->deleteJson($uri);
}

function getAuthHeader(User $user): array
{
    return ['Authorization' => 'Bearer '.getToken($user)];
}

function getToken(User $user): string
{
    return loginAsUser($user);
}

function loginAsUser(?User $user = null): string
{
    $user ?? User::factory()->create();

    $credentials = ['email' => $user->email, 'password' => config('testing.password')];

    $response = postJson(route('login'), $credentials);

    if ($response->status() !== 200) {
        throw new ExpectationFailedException('Login failed');
    }

    return $response['access_token'];
}

function setupHikeWithItems(): Hike
{
    $hikeUser = HikeUser::factory()->create();
    $hike = $hikeUser->hike;

    createPersonalChecklist($hikeUser, 10);
    createCommonChecklist($hike, 5);

    return $hike;
}

function setupHikeWithoutItems(): Hike
{
    $hikeUser = HikeUser::factory()->create();
    $hike = $hikeUser->hike;

    createPersonalChecklist($hikeUser);
    createCommonChecklist($hike);

    return $hike;
}

function createPersonalChecklist(HikeUser $hikeUser, int $numberOfItems = 0): PersonalChecklist
{
    return PersonalChecklist::factory()
        ->for($hikeUser)
        ->has(PersonalChecklistItem::factory($numberOfItems))
        ->create();
}

function createCommonChecklist(Hike $hike, int $numberOfItems = 0): CommonChecklist
{
    return CommonChecklist::factory()
        ->for($hike)
        ->has(CommonChecklistItem::factory($numberOfItems))
        ->create();
}
