<?php

namespace App\Bookkeeping\ExpenseAccount;

use Illuminate\Support\ServiceProvider;

class ExpenseAccountServiceProvider extends ServiceProvider
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
            'App\Bookkeeping\ExpenseAccount\ExpenseAccountInterface',
            'App\Bookkeeping\ExpenseAccount\ExpenseAccountRepository'
        );
    }
}
