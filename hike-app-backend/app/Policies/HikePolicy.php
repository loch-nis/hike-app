<?php

namespace App\Policies;

use App\Models\Hike;
use App\Models\User;

class HikePolicy
{
    public function __call($name, $arguments)
    {
        // todo-X fix
        dump('CREATE NOT FOUND HERE!!!');
        dump($name);
    }

    public function view(User $user, Hike $hike): bool
    {
        return $this->isUserConnectedToHike($user, $hike);
    }

    private function isUserConnectedToHike(User $user, Hike $hike): bool
    {
        if ($user->hikes->find($hike)) {
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
