<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonChecklistController;
use App\Http\Controllers\CommonChecklistItemController;
use App\Http\Controllers\HikeController;
use App\Http\Controllers\PersonalChecklistController;
use App\Http\Controllers\PersonalChecklistItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    Route::middleware('jwt.auth')
        ->group(function () {
            Route::resource('hikes', HikeController::class, [
                'only' => ['index', 'store', 'show'],
            ]);
            Route::get('hikes/{hike}/me/personal-checklist', [PersonalChecklistController::class, 'show']);
            Route::post('hikes/{hike}/me/personal-checklist-items', [PersonalChecklistItemController::class, 'store']);
            // item->id or will this work?
            Route::patch('personal-checklist-items/{item}', [PersonalChecklistItemController::class, 'update']);
            Route::delete('personal-checklist-items/{item}', [PersonalChecklistItemController::class, 'destroy']);

            Route::get('hikes/{hike}/common-checklist', [CommonChecklistController::class, 'show']);
            Route::post('hikes/{hike}/common-checklist-items', [CommonChecklistItemController::class, 'store']);
            Route::patch('common-checklist-items/{item}', [CommonChecklistItemController::class, 'update']);
            Route::delete('common-checklist-items/{item}', [CommonChecklistItemController::class, 'destroy']);


        });

    Route::prefix('auth')
        ->middleware('api')
        ->group(function () {

            Route::middleware('guest.api')->group(function () {
                Route::post('login', [AuthController::class, 'login']);
                Route::post('register', [AuthController::class, 'register']);
            });

            Route::middleware('jwt.auth')->group(function () {
                Route::post('logout', [AuthController::class, 'logout']);
                Route::post('refresh', [AuthController::class, 'refresh']);
                Route::get('me', [AuthController::class, 'me']);
            });
        });
// todo laravel pint and code formatter conflict fix

});


