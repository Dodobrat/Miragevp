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

    public function created(User $current_user)
    {
        $current_user->notify(new UserCreated);
    }
}