<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Order $order)
    {
        return true;
    }

    public function create(User $user)
    {
        return true; // Any authenticated user can create orders
    }

    public function update(User $user, Order $order)
    {
        return true;
    }

    public function delete(User $user, Order $order)
    {
        return true;
    }
}