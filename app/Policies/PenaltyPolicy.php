<?php

namespace App\Policies;

use App\Models\Penalty;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenaltyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->permissions->contains('name', 'viewAny-penalty');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penalty  $penalty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Penalty $penalty)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penalty  $penalty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Penalty $penalty)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penalty  $penalty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Penalty $penalty)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penalty  $penalty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Penalty $penalty)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Penalty  $penalty
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Penalty $penalty)
    {
        //
    }

    public function payPenalty(User $user)
    {
        return $user->permissions->contains('name', 'pay-penalty');
    }
}
