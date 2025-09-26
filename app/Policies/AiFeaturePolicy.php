<?php

namespace App\Policies;

use App\Models\AiFeature;
use App\Models\User;
use App\Policies\Traits\ChecksRole;
use Illuminate\Auth\Access\Response;

class AiFeaturePolicy
{
    use ChecksRole;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AiFeature $aiFeature): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AiFeature $aiFeature): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AiFeature $aiFeature): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AiFeature $aiFeature): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AiFeature $aiFeature): bool
    {
        return $user->hasRole('admin');
    }
}
