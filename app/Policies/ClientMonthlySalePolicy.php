<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientMonthlySale;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientMonthlySalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clientMonthlySale can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientMonthlySale can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function view(User $user, ClientMonthlySale $model)
    {
        return true;
    }

    /**
     * Determine whether the clientMonthlySale can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientMonthlySale can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function update(User $user, ClientMonthlySale $model)
    {
        return true;
    }

    /**
     * Determine whether the clientMonthlySale can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function delete(User $user, ClientMonthlySale $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientMonthlySale can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function restore(User $user, ClientMonthlySale $model)
    {
        return false;
    }

    /**
     * Determine whether the clientMonthlySale can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientMonthlySale  $model
     * @return mixed
     */
    public function forceDelete(User $user, ClientMonthlySale $model)
    {
        return false;
    }
}
