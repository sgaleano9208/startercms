<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TypeOfPayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeOfPaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the typeOfPayment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typeOfPayment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function view(User $user, TypeOfPayment $model)
    {
        return true;
    }

    /**
     * Determine whether the typeOfPayment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typeOfPayment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function update(User $user, TypeOfPayment $model)
    {
        return true;
    }

    /**
     * Determine whether the typeOfPayment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function delete(User $user, TypeOfPayment $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the typeOfPayment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function restore(User $user, TypeOfPayment $model)
    {
        return false;
    }

    /**
     * Determine whether the typeOfPayment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeOfPayment  $model
     * @return mixed
     */
    public function forceDelete(User $user, TypeOfPayment $model)
    {
        return false;
    }
}
