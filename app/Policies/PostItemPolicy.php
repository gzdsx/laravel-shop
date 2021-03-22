<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PostItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostItemPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the post item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PostItem $postItem
     * @return mixed
     */
    public function view(User $user, PostItem $postItem)
    {
        return true;
    }

    /**
     * Determine whether the user can create post items.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the post item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PostItem $postItem
     * @return mixed
     */
    public function update(User $user, PostItem $postItem)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->uid == $postItem->uid;
    }

    /**
     * Determine whether the user can delete the post item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PostItem $postItem
     * @return mixed
     */
    public function delete(User $user, PostItem $postItem)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->uid == $postItem->uid;
    }

    /**
     * Determine whether the user can restore the post item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PostItem $postItem
     * @return mixed
     */
    public function restore(User $user, PostItem $postItem)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->uid == $postItem->uid;
    }

    /**
     * Determine whether the user can permanently delete the post item.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PostItem $postItem
     * @return mixed
     */
    public function forceDelete(User $user, PostItem $postItem)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->uid == $postItem->uid;
    }

    /**
     * @param User $user
     * @param PostItem $postItem
     * @return bool
     */
    public function own(User $user, PostItem $postItem)
    {
        return $user->uid == $postItem->uid;
    }

    /**
     * @param User $user
     * @param PostItem $postItem
     * @return bool
     */
    public function preview(User $user, PostItem $postItem)
    {
        if ($postItem->state == 1) {
            return true;
        }

        if ($user->isAdmin()) {
            return true;
        }
        return $user->uid == $postItem->uid;
    }
}
