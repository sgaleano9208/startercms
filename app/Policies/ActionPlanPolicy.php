<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ActionPlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the actionPlan can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the actionPlan can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function view(User $user, ActionPlan $model)
    {
        return true;
    }

    /**
     * Determine whether the actionPlan can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the actionPlan can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function update(User $user, ActionPlan $model)
    {
        return true;
    }

    /**
     * Determine whether the actionPlan can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function delete(User $user, ActionPlan $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the actionPlan can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function restore(User $user, ActionPlan $model)
    {
        return false;
    }

    /**
     * Determine whether the actionPlan can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActionPlan  $model
     * @return mixed
     */
    public function forceDelete(User $user, ActionPlan $model)
    {
        return false;
    }
}
