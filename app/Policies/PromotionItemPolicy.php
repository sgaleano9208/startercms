<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PromotionItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the promotionItem can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotionItem can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function view(User $user, PromotionItem $model)
    {
        return true;
    }

    /**
     * Determine whether the promotionItem can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotionItem can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function update(User $user, PromotionItem $model)
    {
        return true;
    }

    /**
     * Determine whether the promotionItem can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function delete(User $user, PromotionItem $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the promotionItem can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function restore(User $user, PromotionItem $model)
    {
        return false;
    }

    /**
     * Determine whether the promotionItem can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PromotionItem  $model
     * @return mixed
     */
    public function forceDelete(User $user, PromotionItem $model)
    {
        return false;
    }
}
