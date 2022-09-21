<?php

namespace App\Policies;

use App\Models\Size;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SizePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the size can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the size can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function view(User $user, Size $model)
    {
        return true;
    }

    /**
     * Determine whether the size can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the size can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function update(User $user, Size $model)
    {
        return true;
    }

    /**
     * Determine whether the size can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function delete(User $user, Size $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the size can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function restore(User $user, Size $model)
    {
        return false;
    }

    /**
     * Determine whether the size can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Size  $model
     * @return mixed
     */
    public function forceDelete(User $user, Size $model)
    {
        return false;
    }
}
