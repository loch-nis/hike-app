<?php

namespace App\Policies;

use App\Models\CommonChecklistItem;
use App\Models\Hike;
use App\Models\User;

class CommonChecklistItemPolicy
{
    public function create(User $user, Hike $hike): bool
    {
        return false;
    }

    public function update(User $user, CommonChecklistItem $commonChecklistItem): bool
    {
        return false;
    }

    public function delete(User $user, CommonChecklistItem $commonChecklistItem): bool
    {
        return false;
    }
}
