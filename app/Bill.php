<?php

namespace App;

use App\Budget;
use App\Purchases;
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

    /**
     * Get payments made to bill
     * 
     */
    public function amount(Bill $bill, Budget $budget)
    {
        $payments = Purchase::where(['bill_id' => $bill->id, 'budget_id' => $budget->id])->get();
        $amount = $payments->reduce(function($carry, $purchase) {
            return $carry + $purchase->amount;
        });

        return number_format( (float) $amount, 2 );
    }

}
