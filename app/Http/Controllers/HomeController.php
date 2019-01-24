<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Account;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $budgets = Budget::All();
        $accounts = Account::All();

        return view('home', compact('budgets', 'accounts'));
    }
}
