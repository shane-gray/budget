<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
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
        if( $request->ajax() ) {
            return response()->json([
                'html' => [
                    '#modal .modal-content' => view('accounts.create')->render()
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
        // Data validation
        $data = $request->validate([
            'name' => 'required',
            'balance' => 'required|numeric'
        ]);

        // Insertion
        $data['user_id'] = auth()->id();
        $account = Account::create($data);

        // Response
        $accounts = auth()->user()->accounts;

        return response()->json([
            'message' => 'Account created successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        // Authorize
        $this->authorize('owns', $account);

        // Response
        return response()->json([
            'html' => [
                '#modal .modal-content' => view('accounts.edit', compact('account'))->render()
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        // Authorize
        $this->authorize('owns', $account);

        // Validate
        $data = $request->validate([
            'name' => 'required',
            'balance' => 'required|numeric'
        ]);

        // Update
        $account->update($data);

        // Response
        $accounts = auth()->user()->accounts;

        return response()->json([
            'message' => 'Account updated successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render()
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        // Authorize
        $this->authorize('owns', $account);

        // Delete
        $account->delete();

        // Response
        $accounts = auth()->user()->accounts;

        return response()->json([
            'message' => 'Account deleted successfully.',
            'html' => [
                '.card__accounts' => view('accounts.list', compact('accounts'))->render()
            ]
        ]);
    }
}
