<?php

namespace App\Http\Controllers\Auth;

use App\Budget;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     */
    public function redirectTo()
    {
        $budget = Auth::user()->budgets()->orderBy('created_at', 'desc')->first();

        if( $budget ) {
            return '/budgets/' . $budget->id;
        } else {
            return '/';
        }
    }

    /**
     * The user has been authenticated.
     *
     */
    protected function authenticated()
    {
        $budget = Auth::user()->budgets()->orderBy('created_at', 'desc')->first();

        if( $budget ) {
            return redirect('/budgets/' . $budget->id);
        } else {
            return redirect('/');
        }
    }
}
