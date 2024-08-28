<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{

    public function index(User $user)
    {
        return $user->type == User::ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function store(User $user)
    {
        return $user->type == User::ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function show(User $user)
    {
        return $user->type == User::ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function update(User $user, Product $product)
    {
        return $user->type == User::ADMIN && $user->id === $product->admin_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function destroy(User $user)
    {
        return $user->type == User::ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
