<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Typology;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypologyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the typology can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typology can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function view(User $user, Typology $model)
    {
        return true;
    }

    /**
     * Determine whether the typology can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typology can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function update(User $user, Typology $model)
    {
        return true;
    }

    /**
     * Determine whether the typology can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function delete(User $user, Typology $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typology can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function restore(User $user, Typology $model)
    {
        return false;
    }

    /**
     * Determine whether the typology can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Typology  $model
     * @return mixed
     */
    public function forceDelete(User $user, Typology $model)
    {
        return false;
    }
}
