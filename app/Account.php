<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    /**
     * Get the purchases tied to this account
     * 
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'from_account');
    }

}
