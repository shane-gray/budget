<?php

namespace App\Policies;

use App\User;
use App\Budget;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given budget can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user, Budget $budget)
    {
        return $user->id === $budget->user_id;
    }
}
