<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientSalesDrop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientSalesDropPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clientSalesDrop can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDrop can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function view(User $user, ClientSalesDrop $model)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDrop can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDrop can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function update(User $user, ClientSalesDrop $model)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDrop can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function delete(User $user, ClientSalesDrop $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDrop can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function restore(User $user, ClientSalesDrop $model)
    {
        return false;
    }

    /**
     * Determine whether the clientSalesDrop can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDrop  $model
     * @return mixed
     */
    public function forceDelete(User $user, ClientSalesDrop $model)
    {
        return false;
    }
}
