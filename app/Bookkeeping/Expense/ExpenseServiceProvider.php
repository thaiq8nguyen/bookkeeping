<?php

namespace App\Bookkeeping\Expense;

use Illuminate\Support\ServiceProvider;

class ExpenseServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Bookkeeping\Expense\ExpenseInterface', 'App\Bookkeeping\Expense\ExpenseRepository');

    }
}