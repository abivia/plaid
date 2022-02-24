<?php

namespace Abivia\Plaid;

use Illuminate\Support\ServiceProvider;
//use Abivia\Plaid\Commands\PlaidExampleCommand;

class PlaidServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('plaid', function($app) {
            return new Plaid();
        });
    }

}
