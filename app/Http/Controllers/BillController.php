<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Budget;
use Illuminate\Http\Request;

class BillController extends Controller
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
        // Validation
        $request->validate([
            'budget_id' => 'required|exists:budgets,id|integer'
        ]);

        // Response
        $budget = Budget::find($request->budget_id);

        return response()->json([
            'html' => [
                '#modal .modal-content' => view('bills.create', compact('budget'))->render()
            ]
        ]);
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
            'name' => 'required'
        ]);

        $budget = Budget::find($data['budget_id']);
        $this->authorize('update', $budget);

        // Create
        Bill::create([
            'user_id' => auth()->id(),
            'name' => $request->name
        ]);

        // Response
        $bills = auth()->user()->bills;

        return response()->json([
            'message' => 'Bill added successfully',
            'html' => [
                '.card__bills' => view('bills.list', compact('budget', 'bills'))->render()
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        
    }
    
}
