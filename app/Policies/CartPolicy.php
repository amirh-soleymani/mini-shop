<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    public function get(User $user)
    {
        return $user->type == User::CUSTOMER
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function add(User $user)
    {
        return $user->type == User::CUSTOMER
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function remove(User $user)
    {
        return $user->type == User::CUSTOMER
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
