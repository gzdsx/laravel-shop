<?php

namespace App\Policies;


use App\Models\Live;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LivePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any lives.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the live.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Live $live
     * @return mixed
     */
    public function view(User $user, Live $live)
    {
        if ($live->watch_mode == 1) {
            return true;
        }

        if ($live->buyLogs()->where('uid', $user->uid)->first()) {
            return true;
        }

        return $user->uid == $live->uid;
    }

    /**
     * Determine whether the user can create lives.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the live.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Live $live
     * @return mixed
     */
    public function update(User $user, Live $live)
    {
        //
    }

    /**
     * Determine whether the user can delete the live.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Live $live
     * @return mixed
     */
    public function delete(User $user, Live $live)
    {
        //
    }

    /**
     * Determine whether the user can restore the live.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Live $live
     * @return mixed
     */
    public function restore(User $user, Live $live)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the live.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Live $live
     * @return mixed
     */
    public function forceDelete(User $user, Live $live)
    {
        //
    }
}
