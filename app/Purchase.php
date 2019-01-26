<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    
    /**
     * Get the budget this purchase is assigned
     * to.
     * 
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }

}
