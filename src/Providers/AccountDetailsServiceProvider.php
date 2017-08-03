<?php

namespace AccessManager\AccountDetails\Providers;


use AccessManager\Accounts\Models\Account;
use Illuminate\Support\ServiceProvider;

class AccountDetailsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom( __DIR__ . "/../Routes/web.php");
        $this->loadViewsFrom( __DIR__ . "/../Views", "AccountDetails");

        $this->composeView();
    }

    protected function composeView()
    {

        view()->composer('AccountDetails::partials.account-info', function($view){
            $account = Account::where('username', request()->segment(2))->firstOrFail();

            $view->with(compact('account'));
        });
    }
}