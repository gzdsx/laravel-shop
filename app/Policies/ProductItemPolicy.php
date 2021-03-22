<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductItemPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->admincp) return true;
    }

    /**
     * Determine whether the user can view the item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\ProductItem $productItem
     * @return mixed
     */
    public function view(User $user, ProductItem $productItem)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($productItem->on_sale) {
            return true;
        }

        return $user->uid == $productItem->uid;
    }

    /**
     * Determine whether the user can create items.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\ProductItem $productItem
     * @return mixed
     */
    public function update(User $user, ProductItem $productItem)
    {
        return $user->uid == $productItem->uid;
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\ProductItem $productItem
     * @return mixed
     */
    public function delete(User $user, ProductItem $productItem)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->uid == $productItem->uid;
    }

    /**
     * @param User $user
     * @param ProductItem $productItem
     * @return bool
     */
    public function buy(User $user, ProductItem $productItem)
    {
        if ($user->uid == $productItem->uid) {
            return false;
        }

        if ($productItem->stock < 1) {
            return false;
        }
        return true;
    }
}
