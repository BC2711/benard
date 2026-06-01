<?php

namespace App\Policies;

use App\Models\User;

class CmsPolicy
{
    public function before(User $user): ?bool
    {
        return $user->role === 'ADMIN' ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, object $model): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, object $model): bool
    {
        return false;
    }

    public function delete(User $user, object $model): bool
    {
        return false;
    }
}
