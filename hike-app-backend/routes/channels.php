<?php

use App\Models\CommonChecklist;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['jwt.auth']]);

Broadcast::channel('commonChecklist.{commonChecklist}', function (User $user, CommonChecklist $commonChecklist) {
    return $user->can('view', $commonChecklist->hike);
}, ['guards' => ['api']]);
