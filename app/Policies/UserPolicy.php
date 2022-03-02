<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAll(User $user){
        return $user->admin === 1;
    }

    public function approveUser(User $user){
        return true;
    }

    public function admin(User $user){
        return $user->admin === 1;
    }

    public function update(User $user){
        if(auth()->user()->admin == 1 || auth()->user()->id === $user->id){
            return true;
        }
    }
}
