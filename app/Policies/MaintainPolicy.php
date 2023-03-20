<?php

namespace App\Policies;

use App\User;
use App\Maintain;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can use any maintains.
     * 
     * @param \App\User $user
     * @return bool
     */
    public function before($user, $ability)
    {
        //
    }

    /**
     * Determine whether the user can view any maintains.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the maintain.
     *
     * @param  \App\User  $user
     * @param  \App\Maintain  $maintain
     * @return bool
     */
    public function view(User $user, Maintain $maintain)
    {
        //
    }

    /**
     * Determine whether the user can create maintains.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the maintain.
     *
     * @param  \App\User  $user
     * @param  \App\Maintain  $maintain
     * @return bool
     */
    public function update(User $user, Maintain $maintain)
    {
        //
    }

    /**
     * Determine whether the user can delete the maintain.
     *
     * @param  \App\User  $user
     * @param  \App\Maintain  $maintain
     * @return bool
     */
    public function delete(User $user, Maintain $maintain)
    {
        //
    }

    /**
     * Determine whether the user can restore the maintain.
     *
     * @param  \App\User  $user
     * @param  \App\Maintain  $maintain
     * @return bool
     */
    public function restore(User $user, Maintain $maintain)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the maintain.
     *
     * @param  \App\User  $user
     * @param  \App\Maintain  $maintain
     * @return bool
     */
    public function forceDelete(User $user, Maintain $maintain)
    {
        //
    }
}
