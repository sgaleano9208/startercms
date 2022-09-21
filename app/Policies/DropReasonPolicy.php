<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DropReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class DropReasonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the dropReason can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dropReason can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function view(User $user, DropReason $model)
    {
        return true;
    }

    /**
     * Determine whether the dropReason can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dropReason can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function update(User $user, DropReason $model)
    {
        return true;
    }

    /**
     * Determine whether the dropReason can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function delete(User $user, DropReason $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dropReason can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function restore(User $user, DropReason $model)
    {
        return false;
    }

    /**
     * Determine whether the dropReason can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\DropReason  $model
     * @return mixed
     */
    public function forceDelete(User $user, DropReason $model)
    {
        return false;
    }
}
