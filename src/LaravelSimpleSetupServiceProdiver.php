<?php

namespace rowo\LaravelSimpleSetup;

use Illuminate\Support\ServiceProvider;

class LaravelSimpleSetupServiceProdiver extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       // include __DIR__.'/routes.php';

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/views', 'LaravelSimpleSetup');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('rowo\LaravelSimpleSetup\SetupController');
        $this->app->make('rowo\LaravelSimpleSetup\TestDbController');




    }
}
