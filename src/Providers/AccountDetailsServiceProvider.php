<?php

namespace AccessManager\AccountDetails\Providers;


use AccessManager\AccountDetails\AccountSubscription\Models\AccountSubscription;
use AccessManager\Accounts\Models\Account;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccountDetailsServiceProvider
 * @package AccessManager\AccountDetails
 */
class AccountDetailsServiceProvider extends ServiceProvider
{
    /**
     * here we register package's migrations, views & routes.
     */
    public function boot()
    {
        $this->bootAccountDetails();
        $this->bootAccountSubscriptions();
        $this->loadMigrationsFrom( __DIR__ . "/../Database/Migrations");
    }

    protected function bootAccountDetails()
    {
        $this->loadRoutesFrom( __DIR__ . "/../AccountDetails/Routes/web.php");
        $this->loadViewsFrom( __DIR__ . "/../AccountDetails/Views", "AccountDetails");
        $this->composeAccountDetailsView();
    }

    protected function bootAccountSubscriptions()
    {
        $this->loadRoutesFrom( __DIR__ . "/../AccountSubscription/Routes/web.php");
        $this->loadViewsFrom( __DIR__ . "/../AccountSubscription/Views", "AccountSubscription");
        $this->composeAccountSubscriptionView();
    }

    protected function composeAccountDetailsView()
    {
        view()->composer('AccountDetails::layout', function($view){
            $account = Account::where('username', request()->segment(2))->firstOrFail();

            $view->with(compact('account'));
        });
    }

    protected function composeAccountSubscriptionView()
    {
        view()->composer('AccountSubscription::layout', function($view){
            $account = Account::where('username', request()->segment(2))->firstOrFail();
            $subscription = AccountSubscription::where('username', request()->segment(4))->firstOrFail();

            $view->with(compact('account', 'subscription'));
        });
    }
}