<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProposalItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the proposalItem can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposalItem can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function view(User $user, ProposalItem $model)
    {
        return true;
    }

    /**
     * Determine whether the proposalItem can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposalItem can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function update(User $user, ProposalItem $model)
    {
        return true;
    }

    /**
     * Determine whether the proposalItem can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function delete(User $user, ProposalItem $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the proposalItem can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function restore(User $user, ProposalItem $model)
    {
        return false;
    }

    /**
     * Determine whether the proposalItem can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProposalItem  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProposalItem $model)
    {
        return false;
    }
}
