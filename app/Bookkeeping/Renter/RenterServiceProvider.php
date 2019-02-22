<?php

namespace App\Bookkeeping\Renter;

use Illuminate\Support\ServiceProvider;

class RenterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Bookkeeping\Renter\RenterInterface',
            'App\Bookkeeping\Renter\RenterRepository'
        );
    }
}