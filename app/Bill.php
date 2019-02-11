<?php

namespace App;

use App\Budget;
use App\Transactions;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    
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
        $payments = Transaction::where(['bill_id' => $bill->id, 'budget_id' => $budget->id])->get();
        $amount = $payments->reduce(function($carry, $transaction) {
            return $carry + $transaction->amount;
        });

        return number_format( (float) $amount, 2 );
    }

}
