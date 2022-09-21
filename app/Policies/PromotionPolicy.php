<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Promotion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the promotion can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotion can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function view(User $user, Promotion $model)
    {
        return true;
    }

    /**
     * Determine whether the promotion can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotion can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function update(User $user, Promotion $model)
    {
        return true;
    }

    /**
     * Determine whether the promotion can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function delete(User $user, Promotion $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotion can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function restore(User $user, Promotion $model)
    {
        return false;
    }

    /**
     * Determine whether the promotion can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Promotion  $model
     * @return mixed
     */
    public function forceDelete(User $user, Promotion $model)
    {
        return false;
    }
}
