<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    
    /**
     * Get the user that owns the bill.
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
