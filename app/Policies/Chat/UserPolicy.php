<?php

namespace App\Policies\Chat;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function talkTo(User $user,User $to){
        return $user->id != $to->id;
    }
}
