<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
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
