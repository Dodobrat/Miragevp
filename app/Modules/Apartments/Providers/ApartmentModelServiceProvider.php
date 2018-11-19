<?php

namespace App\Modules\Apartments\Providers;

use Illuminate\Support\ServiceProvider;

class ApartmentModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Modules\Apartments\Models\Apartments::observe(\App\Observers\ApartmentObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
