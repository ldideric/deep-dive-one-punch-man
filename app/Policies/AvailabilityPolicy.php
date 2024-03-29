<?php

namespace App\Policies;

use App\Models\Availability;
use App\Models\User;

class AvailabilityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Availability $availability): bool
    {
        return $availability->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Availability $availability): bool
    {
        return $availability->user_id === $user->id;
    }

    public function delete(User $user, Availability $availability): bool
    {
        return $availability->user_id === $user->id;
    }
}
