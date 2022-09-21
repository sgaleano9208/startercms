<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Family;
use Illuminate\Auth\Access\HandlesAuthorization;

class FamilyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the family can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the family can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function view(User $user, Family $model)
    {
        return true;
    }

    /**
     * Determine whether the family can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the family can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function update(User $user, Family $model)
    {
        return true;
    }

    /**
     * Determine whether the family can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function delete(User $user, Family $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the family can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function restore(User $user, Family $model)
    {
        return false;
    }

    /**
     * Determine whether the family can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Family  $model
     * @return mixed
     */
    public function forceDelete(User $user, Family $model)
    {
        return false;
    }
}
