<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientCooperativeHistory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientCooperativeHistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clientCooperativeHistory can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientCooperativeHistory can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function view(User $user, ClientCooperativeHistory $model)
    {
        return true;
    }

    /**
     * Determine whether the clientCooperativeHistory can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientCooperativeHistory can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function update(User $user, ClientCooperativeHistory $model)
    {
        return true;
    }

    /**
     * Determine whether the clientCooperativeHistory can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function delete(User $user, ClientCooperativeHistory $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientCooperativeHistory can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function restore(User $user, ClientCooperativeHistory $model)
    {
        return false;
    }

    /**
     * Determine whether the clientCooperativeHistory can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientCooperativeHistory  $model
     * @return mixed
     */
    public function forceDelete(User $user, ClientCooperativeHistory $model)
    {
        return false;
    }
}
