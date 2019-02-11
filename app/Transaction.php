<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Get the budget this transaction is assigned
     * to.
     * 
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }

    /**
     * Get the account this transaction is assigned
     * to.
     * 
     */
    public function account()
    {
        return $this->belongsTo('App\Account', 'from_account');
    }

}
