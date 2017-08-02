<?php

namespace AccessManager\AccountDetails\Providers;


use Illuminate\Support\ServiceProvider;

class AccountDetailsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom( __DIR__ . "/../Routes/web.php");
        $this->loadViewsFrom( __DIR__ . "/../Views", "AccountDetails");
    }
}