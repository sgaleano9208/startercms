<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientSalesDropDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientSalesDropDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the clientSalesDropDetail can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDropDetail can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function view(User $user, ClientSalesDropDetail $model)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDropDetail can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDropDetail can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function update(User $user, ClientSalesDropDetail $model)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDropDetail can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function delete(User $user, ClientSalesDropDetail $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the clientSalesDropDetail can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function restore(User $user, ClientSalesDropDetail $model)
    {
        return false;
    }

    /**
     * Determine whether the clientSalesDropDetail can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClientSalesDropDetail  $model
     * @return mixed
     */
    public function forceDelete(User $user, ClientSalesDropDetail $model)
    {
        return false;
    }
}
