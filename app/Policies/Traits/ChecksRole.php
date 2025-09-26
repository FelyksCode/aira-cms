<?php

namespace App\Policies\Traits;

use Illuminate\Auth\Access\Response;
use App\Models\User;

trait ChecksRole
{
    protected function allowIfAdmin(User $user): Response
    {
        return $user->role->name === 'admin'
            ? Response::allow()
            : Response::deny();
    }

    protected function allowIfUserOrAdmin(User $user): Response
    {
        return in_array($user->role->name, ['admin', 'user'])
            ? Response::allow()
            : Response::deny();
    }
}
