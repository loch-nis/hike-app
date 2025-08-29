<?php

use App\Models\CommonChecklist;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// todo-X make this also use my api and jwt.auth guards/middleware - right now its returning forbidden on a valid checklist because the token is not even being sent in the request headers.. hmm
// idk, chat says this IS using my jwt.auth middleware, but if that was true I should be getting 401 since token is invalid!!! and not 403!!!

Broadcast::routes(['middleware' => ['jwt.auth']]); // does this fix the above?
// YES!!! Am now getting 401 :DDDD -> maybe this can be inlined/written just on the one below - like replace 'guards' with 'middleware'?

Broadcast::channel('commonChecklist.{commonChecklist}', function (User $user, CommonChecklist $commonChecklist) {
    return $user->can('view', $commonChecklist->hike);
}, ['guards' => ['api']]);
