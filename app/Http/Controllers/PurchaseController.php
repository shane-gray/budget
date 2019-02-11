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
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax() && $request->budget_id) {

            // Authorization
            $budget = Budget::find($request->budget_id);
            $this->authorize('update', $budget);

            // Response
            $accounts = auth()->user()->accounts;
            $bills = auth()->user()->bills;

            return response()->json([
                'html' => [
                    '#modal .modal-content' => view('purchases.create', compact('budget', 'accounts', 'bills'))->render()
                ]
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
        // Validation
        $data = $request->validate([
            'budget_id' => 'required|exists:budgets,id|integer',
            'bill_id' => 'required_if:type,bill|exists:bills,id|integer',
            'type' => 'required',
            'from_account' => 'required|exists:accounts,id|integer',
            'to_account' => 'required_if:type,transfer|exists:accounts,id|integer',
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        // Authorization
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
        
        // Create
        $purchase = Purchase::create($data);

        $from_account = Account::find($data['from_account']);
        $from_account->subtract($data['amount']);

        if( $data['type'] == 'transfer' ) {
            $to_account = Account::find($data['to_account']);
            $to_account->add($data['amount']);
        }

        // Response
        $budget = Budget::find($data['budget_id']);
        $accounts = auth()->user()->accounts;
        $purchases = $budget->purchases()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Purchase added successfully.',
            'html' => [
                '.card__purchases' => view('purchases.list', compact('budget', 'accounts', 'purchases'))->render()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        // Authorization
        $budget = Budget::find($purchase->budget_id);
        $this->authorize('update', $budget);

        // Response
        $accounts = auth()->user()->accounts;
        $bills = auth()->user()->bills;

        return response()->json([
            'html' => [
                '#modal .modal-content' => view('purchases.edit', compact('budget', 'accounts', 'bills', 'purchase'))->render()
            ]
        ]);

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
        // Validation
        $data = $request->validate([
            'type' => 'required',
            'from_account' => 'required|exists:accounts,id|integer',
            'to_account' => 'required_if:type,transfer|exists:accounts,id|integer',
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        // Authorization
        $budget = Budget::find($purchase->budget_id);
        $this->authorize('update', $budget);
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

        // Update
        $purchase->update($data);

        // Response
        $accounts = auth()->user()->accounts;
        $purchases = $budget->purchases()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Purchase updated successfully.',
            'html' => [
                '.card__purchases' => view('purchases.list', compact('budget', 'accounts', 'purchases'))->render()
            ]
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        // Authorization
        $budget = Budget::find($purchase->budget_id);
        $this->authorize('update', $budget);

        // Delete
        $purchase->delete();

        // Response
        $accounts = auth()->user()->accounts;
        $purchases = $budget->purchases()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Purchase deleted successfully.',
            'html' => [
                '.card__purchases' => view('purchases.list', compact('budget', 'accounts', 'purchases'))->render(),
                '#modal .modal-footer, #modal .modal-body .form-row' => ''
            ]
        ]);
    }
}
