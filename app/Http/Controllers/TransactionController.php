<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Budget;
use App\Account;
use App\Bill;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
                    '#modal .modal-content' => view('transactions.create', compact('budget', 'accounts', 'bills'))->render()
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
        $transaction = Transaction::create($data);
    
        $from_account = Account::find($data['from_account']);

        if( $data['type'] == 'deposit' )
            $from_account->add($data['amount']);
        else
            $from_account->subtract($data['amount']);

        if( $data['type'] == 'transfer' ) {
            $to_account = Account::find($data['to_account']);
            $to_account->add($data['amount']);
        }

        // Response
        $budget = Budget::find($data['budget_id']);
        $accounts = auth()->user()->accounts;
        $transactions = $budget->transactions()->orderBy('created_at', 'desc')->get();
        $bills = auth()->user()->bills;

        return response()->json([
            'message' => 'Transaction added successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render(),
                '.card__transactions' => view('transactions.list', compact('budget', 'accounts', 'transactions'))->render(),
                '.card__bills' => view('bills.list', compact('budget', 'bills'))->render()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        // Authorization
        $budget = Budget::find($transaction->budget_id);
        $this->authorize('update', $budget);

        // Response
        $accounts = auth()->user()->accounts;
        $bills = auth()->user()->bills;

        return response()->json([
            'html' => [
                '#modal .modal-content' => view('transactions.edit', compact('budget', 'accounts', 'bills', 'transaction'))->render()
            ]
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // Validation
        $data = $request->validate([
            'type' => 'required',
            'bill_id' => 'required_if:type,bill|exists:bills,id|integer',
            'from_account' => 'required|exists:accounts,id|integer',
            'to_account' => 'required_if:type,transfer|exists:accounts,id|integer',
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        // Authorization
        $budget = Budget::find($transaction->budget_id);
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

        // Revert old transaction
        $from_account = Account::find($transaction->from_account);

        if( $transaction->type == 'deposit' )
            $from_account->subtract($transaction->amount);
        else
            $from_account->add($transaction->amount);

        if( $transaction->type == 'transfer' ) {
            $to_account = Account::find($transaction->to_account);
            $to_account->subtract($transaction->amount);
        }

        // Update
        $from_account = Account::find($data['from_account']);

        if( $data['type'] == 'deposit' )
            $from_account->add($data['amount']);
        else
            $from_account->subtract($data['amount']);

        if( $data['type'] == 'transfer' ) {
            $to_account = Account::find($data['to_account']);
            $to_account->add($data['amount']);
        }

        $transaction->update($data);

        // Response
        $accounts = auth()->user()->accounts;
        $transactions = $budget->transactions()->orderBy('created_at', 'desc')->get();
        $bills = auth()->user()->bills;

        return response()->json([
            'message' => 'Transaction updated successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render(),
                '.card__transactions' => view('transactions.list', compact('budget', 'accounts', 'transactions'))->render(),
                '.card__bills' => view('bills.list', compact('budget', 'bills'))->render()
            ]
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        // Authorization
        $budget = Budget::find($transaction->budget_id);
        $this->authorize('update', $budget);

        // Delete
        $from_account = Account::find($transaction->from_account);

        if( $transaction->type == 'deposit' )
            $from_account->subtract($transaction->amount);
        else
            $from_account->add($transaction->amount);

        if( $transaction->type == 'transfer' ) {
            $to_account = Account::find($transaction->to_account);
            $to_account->subtract($transaction->amount);
        }

        $transaction->delete();

        // Response
        $accounts = auth()->user()->accounts;
        $transactions = $budget->transactions()->orderBy('created_at', 'desc')->get();
        $bills = auth()->user()->bills;

        return response()->json([
            'message' => 'Transaction deleted successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render(),
                '.card__transactions' => view('transactions.list', compact('budget', 'accounts', 'transactions'))->render(),
                '.card__bills' => view('bills.list', compact('budget', 'bills'))->render(),
                '#modal .modal-footer, #modal .modal-body .form-row' => ''
            ]
        ]);
    }
}
