<?php

use App\Models\CommonChecklist;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('commonChecklist.{commonChecklistId}', function (User $user, string $commonChecklistId) {
    $hike = CommonChecklist::query()->findOrFail($commonChecklistId)->hike;

    return $user->can('view', $hike);
});
