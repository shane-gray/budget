<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Budget;
use App\Account;
use App\Bill;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax() && $request->budget_id) {

            $budget = Budget::find($request->budget_id);
            $this->authorize('update', $budget);

            $accounts = auth()->user()->accounts;
            $bills = auth()->user()->bills;

            return response()->json([
                'html' => view('purchases.create', compact('budget', 'accounts', 'bills'))->render()
            ]);

        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Data validation
        $data = $request->validate([
            'budget_id' => 'required|exists:budgets,id|integer',
            'bill_id' => 'required_if:type,bill|exists:bills,id|integer',
            'type' => 'required',
            'from_account' => 'required|exists:accounts,id|integer',
            'to_account' => 'required_if:type,transfer|exists:accounts,id|integer',
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        // Authorizations
        $this->authorize('update', Budget::find($data['budget_id']));
        $this->authorize('owns', Account::find($data['from_account']));
        
        if( $data['type'] == 'transfer' ) {
            $this->authorize('owns', Account::find($data['to_account']));
        } else {
            $data['to_account'] = null;
        }

        if( $data['type'] == 'bill' ) {
            $this->authorize('owns', Bill::find($data['bill_id']));
        } else {
            $data['bill_id'] = null;
        }
            
        $purchase = Purchase::create($data);

        return response()->json([
            'message' => 'Purchase added successfully.'
        ]);
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
