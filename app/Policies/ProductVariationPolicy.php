<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductVariation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductVariationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productVariation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productVariation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function view(User $user, ProductVariation $model)
    {
        return true;
    }

    /**
     * Determine whether the productVariation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productVariation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function update(User $user, ProductVariation $model)
    {
        return true;
    }

    /**
     * Determine whether the productVariation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function delete(User $user, ProductVariation $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the productVariation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function restore(User $user, ProductVariation $model)
    {
        return false;
    }

    /**
     * Determine whether the productVariation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductVariation  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductVariation $model)
    {
        return false;
    }
}
