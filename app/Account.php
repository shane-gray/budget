<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get the purchases tied to this account
     * 
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'from_account');
    }

    /**
     * Subtract an amount from this account
     * 
     */
    public function subtract(Float $amount)
    {
        $this->balance -= $amount;
        $this->save();
    }

    /**
     * Add an amount to this account
     * 
     */
    public function add(Float $amount)
    {
        $this->balance += $amount;
        $this->save();
    }

}
