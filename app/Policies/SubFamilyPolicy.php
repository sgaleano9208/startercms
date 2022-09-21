<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubFamily;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubFamilyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subFamily can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subFamily can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function view(User $user, SubFamily $model)
    {
        return true;
    }

    /**
     * Determine whether the subFamily can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subFamily can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function update(User $user, SubFamily $model)
    {
        return true;
    }

    /**
     * Determine whether the subFamily can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function delete(User $user, SubFamily $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the subFamily can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function restore(User $user, SubFamily $model)
    {
        return false;
    }

    /**
     * Determine whether the subFamily can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubFamily  $model
     * @return mixed
     */
    public function forceDelete(User $user, SubFamily $model)
    {
        return false;
    }
}
