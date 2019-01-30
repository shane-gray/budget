<?php

namespace App\Policies;

use App\User;
use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user owns the account
     *
     * @param  \App\User        $user
     * @param  \App\Account     $account
     * @return bool
     */
    public function owns(User $user, Account $account)
    {
        return $user->id === $account->user_id;
    }
}
