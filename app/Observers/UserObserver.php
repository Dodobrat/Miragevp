<?php

namespace App\Observers;
use App\Notifications\UserCreated;
use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->last_name = strtoupper($user->last_name);
    }

}