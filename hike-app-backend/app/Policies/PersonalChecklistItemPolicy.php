<?php

namespace App\Policies;

use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;

class PersonalChecklistItemPolicy
{
    public function update(User $user, PersonalChecklistItem $personalChecklistItem): bool
    {
        return $this->userOwnsChecklist($user, $personalChecklistItem->personalChecklist);
    }

    private function userOwnsChecklist(User $user, PersonalChecklist $personalChecklist): bool
    {
        return $user->id === $personalChecklist->hikeUser->user_id;
    }

    public function delete(User $user, PersonalChecklistItem $personalChecklistItem): bool
    {
        return $this->userOwnsChecklist($user, $personalChecklistItem->personalChecklist);
    }
}
