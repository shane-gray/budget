<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    /**
     * Get the user that owns the budget.
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get transactions assigned to budget
     * 
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * Get bill payments assigned to budget
     * 
     */
    public function payments()
    {
        return $this->transactions()->where('type', '=', 'bill');
    }

    /**
     * Get total bill payments amount on budget
     * 
     */
    public function payments_total()
    {
        $bills = auth()->user()->bills;
        
        return $bills->reduce(function($carry, $bill) {
            $carry += $bill->amount($bill, $this);
            return $carry;
        }, 0);
    }

}
