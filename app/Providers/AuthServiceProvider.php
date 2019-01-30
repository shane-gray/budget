<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Budget' => 'App\Policies\BudgetPolicy',
        'App\Purchase' => 'App\Policies\PurchasePolicy',
        'App\Account' => 'App\Policies\AccountPolicy',
        'App\Bill' => 'App\Policies\BillPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
