<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Feedback\Models\Feedback;
use Tipoff\Support\Contracts\Models\UserInterface;

class FeedbackPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view feedbacks') ? true : false;
    }

    public function view(UserInterface $user, Feedback $feedback): bool
    {
        return $user->hasPermissionTo('view feedbacks') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return false;
    }

    public function update(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    public function delete(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Feedback $feedback): bool
    {
        return false;
    }
}
