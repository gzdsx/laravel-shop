<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function buyer(User $user, Order $order)
    {
        return $user->uid == $order->buyer_uid;
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function seller(User $user, Order $order)
    {
        return $user->uid == $order->seller_uid;
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function applyRefund(User $user, Order $order)
    {
        return $user->uid == $order->buyer_uid;
    }
}
