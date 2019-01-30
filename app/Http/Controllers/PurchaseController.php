<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Budget;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'budget_id' => 'required|exists:budgets,id|integer',
            'bill_id' => 'required_if:type,bill|exists:bills,id|integer',
            'type' => 'required',
            'from_account' => 'required|exists:accounts,id|integer',
            'to_account' => 'required_if:type,transfer|exists:accounts,id|integer',
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        $budget = Budget::find($data['budget_id']);
        $this->authorize('update', $budget);
        
        if( $data['type'] != 'transfer' )
            $data['to_account'] = null;

        if( $data['type'] != 'bill' )
            $data['bill_id'] = null;
            
        $purchase = Purchase::create($data);

        return response($purchase, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
