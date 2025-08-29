<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonChecklistController;
use App\Http\Controllers\CommonChecklistItemController;
use App\Http\Controllers\HikeController;
use App\Http\Controllers\PersonalChecklistController;
use App\Http\Controllers\PersonalChecklistItemController;
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
            ->can('view', 'hike') // safe because of the structure of the controller. No point trying to do a deep check in an attempt to future proof, should the way controller works change dramatically. I believe this is a case of YAGNI / avoidance of premature optimization
            ->name('personal-checklist.show');

        Route::post('hikes/{hike}/me/personal-checklist-items', [PersonalChecklistItemController::class, 'store'])
            ->can('view', 'hike')
            ->name('personal-checklist-items.store');

        Route::patch('personal-checklist-items/{personalChecklistItem}',
            [PersonalChecklistItemController::class, 'update'])
            ->can('update', 'personalChecklistItem')
            ->name('personal-checklist-items.update');

        Route::delete('personal-checklist-items/{personalChecklistItem}',
            [PersonalChecklistItemController::class, 'destroy'])
            ->can('delete', 'personalChecklistItem')
            ->name('personal-checklist-items.destroy');

        // todo policies for all these routes - do it test driven! (with BDD naming for the tests)
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
