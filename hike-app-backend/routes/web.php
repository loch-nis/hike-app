<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonChecklistController;
use App\Http\Controllers\CommonChecklistItemController;
use App\Http\Controllers\HikeController;
use App\Http\Controllers\PersonalChecklistController;
use App\Http\Controllers\PersonalChecklistItemController;
use App\Models\PersonalChecklistItem;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(function () {
    Route::middleware('jwt.auth')->group(function () {

        Route::get('hikes', [HikeController::class, 'index'])
            ->name('hikes');

        Route::post('hikes', [HikeController::class, 'store'])
            ->name('hikes.store');

        Route::get('hikes/{hike}', [HikeController::class, 'show'])
            ->can('view', 'hike')
            ->name('hikes.show');

        Route::get('hikes/{hike}/me/personal-checklist', [PersonalChecklistController::class, 'show'])
            ->can('view', 'hike') // todo-X is there a reason to check this on the personal checklist policy instead? no because the auth check is the same on both, so that would not be DRY. And
            // this is the way the whole thing is set up, so no point in trying to future proof EVERYTHING CHANGING. YAGNI ftw
            ->name('personal-checklist.show');

        Route::post('hikes/{hike}/me/personal-checklist-items', [PersonalChecklistItemController::class, 'store'])
            ->can('create', [PersonalChecklistItem::class, 'hike']) // self-quiz: why does this work? Answer is in the policy
            ->name('personal-checklist-items.store');

        Route::patch('personal-checklist-items/{personalChecklistItem}',
            [PersonalChecklistItemController::class, 'update'])
            ->can('update', 'personalChecklistItem')
            ->name('personal-checklist-items.update');

        Route::delete('personal-checklist-items/{personalChecklistItem}',
            [PersonalChecklistItemController::class, 'destroy'])
            ->can('delete', 'personalChecklistItem')
            ->name('personal-checklist-items.destroy');

        // todo-X policies and names for all these routes (and TDD (BDD naming!) tests!!)
        Route::get('hikes/{hike}/common-checklist', [CommonChecklistController::class, 'show'])
            ->name('common-checklist.show');

        Route::post('hikes/{hike}/common-checklist-items', [CommonChecklistItemController::class, 'store'])
            ->name('common-checklist-items.store');

        Route::patch('common-checklist-items/{commonChecklistItem}', [CommonChecklistItemController::class, 'update'])
            ->name('common-checklist-items.update');

        Route::delete('common-checklist-items/{commonChecklistItem}',
            [CommonChecklistItemController::class, 'destroy'])
            ->name('common-checklist-items.destroy');
    });

    Route::prefix('auth')->group(function () {
        Route::middleware('guest.api')->group(function () {

            Route::post('login', [AuthController::class, 'login'])
                ->name('login');

            Route::post('register', [AuthController::class, 'register'])
                ->name('register');
        });

        Route::middleware('jwt.auth')->group(function () {

            Route::post('logout', [AuthController::class, 'logout'])
                ->name('logout');

            Route::post('refresh', [AuthController::class, 'refresh'])
                ->name('refresh');

            Route::get('me', [AuthController::class, 'me'])
                ->name('me');

        });
    });
});
