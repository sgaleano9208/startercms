<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ZoneAppointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZoneAppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the zoneAppointment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the zoneAppointment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function view(User $user, ZoneAppointment $model)
    {
        return true;
    }

    /**
     * Determine whether the zoneAppointment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the zoneAppointment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function update(User $user, ZoneAppointment $model)
    {
        return true;
    }

    /**
     * Determine whether the zoneAppointment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function delete(User $user, ZoneAppointment $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the zoneAppointment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function restore(User $user, ZoneAppointment $model)
    {
        return false;
    }

    /**
     * Determine whether the zoneAppointment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ZoneAppointment  $model
     * @return mixed
     */
    public function forceDelete(User $user, ZoneAppointment $model)
    {
        return false;
    }
}
