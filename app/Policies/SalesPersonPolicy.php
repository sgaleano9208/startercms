<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesPerson;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesPersonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesPerson can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salesPerson can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function view(User $user, SalesPerson $model)
    {
        return true;
    }

    /**
     * Determine whether the salesPerson can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salesPerson can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function update(User $user, SalesPerson $model)
    {
        return true;
    }

    /**
     * Determine whether the salesPerson can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function delete(User $user, SalesPerson $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the salesPerson can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function restore(User $user, SalesPerson $model)
    {
        return false;
    }

    /**
     * Determine whether the salesPerson can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SalesPerson  $model
     * @return mixed
     */
    public function forceDelete(User $user, SalesPerson $model)
    {
        return false;
    }
}
