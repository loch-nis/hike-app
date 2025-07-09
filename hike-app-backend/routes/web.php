<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HikeController;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->middleware('api')->group(function () {
    Route::prefix('hikes')
        ->middleware('jwt.auth')
        ->group(function () {
            Route::get('/', [HikeController::class, 'index']);
            Route::post('/', [HikeController::class, 'store']);
            Route::get('/{id}', [HikeController::class, 'show']);
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

});
