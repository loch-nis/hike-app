<?php

namespace App\Policies;

use App\Models\Hike;
use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;

class PersonalChecklistItemPolicy
{
    // self-quiz answer:
    /**
     * Policy conventions:
     * When a child resource belongs to a parent
     * always call policy middleware as:
     * ->can('ability', [ChildModel::class, 'parentRouteParam'])
     * This ensures:
     *   - Consistent policy targeting
     *   - Parent model is route bound and injected
     *   - No accidental lookup in the parent's policy
     */
    public function create(User $user, Hike $hike): bool
    {
        if ($user->hikes->find($hike)) {
            return true;
        }

        return false;
    }

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
