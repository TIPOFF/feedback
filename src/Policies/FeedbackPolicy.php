<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Support\Contracts\Models\UserInterface;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view feedbacks') ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Feedback  $feedback
     * @return mixed
     */
    public function view(UserInterface $user, Feedback $feedback): bool
    {
        return $user->hasPermissionTo('view feedbacks') ? true : false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(UserInterface $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Feedback  $feedback
     * @return mixed
     */
    public function update(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Feedback  $feedback
     * @return mixed
     */
    public function delete(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Feedback  $feedback
     * @return mixed
     */
    public function restore(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Feedback  $feedback
     * @return mixed
     */
    public function forceDelete(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }
}
