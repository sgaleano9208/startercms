<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cooperative;
use Illuminate\Auth\Access\HandlesAuthorization;

class CooperativePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the cooperative can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cooperative can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function view(User $user, Cooperative $model)
    {
        return true;
    }

    /**
     * Determine whether the cooperative can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cooperative can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function update(User $user, Cooperative $model)
    {
        return true;
    }

    /**
     * Determine whether the cooperative can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function delete(User $user, Cooperative $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the cooperative can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function restore(User $user, Cooperative $model)
    {
        return false;
    }

    /**
     * Determine whether the cooperative can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Cooperative  $model
     * @return mixed
     */
    public function forceDelete(User $user, Cooperative $model)
    {
        return false;
    }
}
