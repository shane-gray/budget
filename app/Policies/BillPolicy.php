<?php

namespace App\Policies;

use App\User;
use App\Bill;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user owns the bill
     *
     * @param  \App\User  $user
     * @param  \App\Bill  $bill
     * @return bool
     */
    public function owns(User $user, Bill $bill)
    {
        return $user->id === $bill->user_id;
    }
}
