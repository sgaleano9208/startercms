<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Competitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the competitor can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the competitor can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function view(User $user, Competitor $model)
    {
        return true;
    }

    /**
     * Determine whether the competitor can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the competitor can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function update(User $user, Competitor $model)
    {
        return true;
    }

    /**
     * Determine whether the competitor can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function delete(User $user, Competitor $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the competitor can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function restore(User $user, Competitor $model)
    {
        return false;
    }

    /**
     * Determine whether the competitor can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Competitor  $model
     * @return mixed
     */
    public function forceDelete(User $user, Competitor $model)
    {
        return false;
    }
}
