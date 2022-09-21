<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the proposal can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposal can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function view(User $user, Proposal $model)
    {
        return true;
    }

    /**
     * Determine whether the proposal can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposal can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function update(User $user, Proposal $model)
    {
        return true;
    }

    /**
     * Determine whether the proposal can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function delete(User $user, Proposal $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposal can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function restore(User $user, Proposal $model)
    {
        return false;
    }

    /**
     * Determine whether the proposal can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Proposal  $model
     * @return mixed
     */
    public function forceDelete(User $user, Proposal $model)
    {
        return false;
    }
}
