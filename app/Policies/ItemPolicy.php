<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        if ($user->admincp) return true;
    }

    /**
     * Determine whether the user can view the item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Item $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        return true;
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
     * @param \App\Models\Item $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return $user->uid == $item->uid;
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Item $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        return $user->admincp;
    }

    /**
     * @param User $user
     * @param Item $item
     * @return bool
     */
    public function buy(User $user, Item $item)
    {
        if ($user->uid == $item->uid){
            return false;
        }
        return true;
    }

    public function preview(User $user, Item $item){
        if ($user->isAdmin()){
            return true;
        }

        return $user->uid == $item->uid;
    }
}
