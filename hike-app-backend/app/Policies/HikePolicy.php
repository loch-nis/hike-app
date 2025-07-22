<?php

namespace App\Policies;

use App\Models\Hike;
use App\Models\User;

class HikePolicy
{
    public function view(User $user, Hike $hike): bool
    {
        $isUserConnectedToHike = $user->hikeUsers()->where("hike_id", $hike->id)->exists();
        if ($isUserConnectedToHike) {
            return true;
        }


        return false;
    }

    public function update(User $user, Hike $hike): bool
    {
        return false;
    }

    public function delete(User $user, Hike $hike): bool
    {
        return false;
    }

}
