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
     * Get purchases assigned to budget
     * 
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    /**
     * Get bill payments assigned to budget
     * 
     */
    public function payments()
    {
        return $this->purchases()->where('type', '=', 'bill');
    }

}
