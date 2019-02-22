<?php

namespace App\Bookkeeping\File;

use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
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
            'App\Bookkeeping\File\FileInterface',
            'App\Bookkeeping\File\FileRepository'
        );
    }
}
