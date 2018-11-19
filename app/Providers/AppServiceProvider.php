<?php

namespace App\Providers;

use App\Modules\Apartments\Models\Apartments;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        \App\User::creating(function($model){
//            $model->last_name = strtoupper($model->last_name);
//        });
        $this->publishes([
            __DIR__.'/../../vendor/provision/administration/resources/views' => resource_path('views/vendor/administration'),
        ],'administration');
        $this->publishes([
            __DIR__.'/../../vendor/provision/administration/resources/lang' => resource_path('lang/vendor/administration'),
        ],'administration-lang');
        $this->publishes([
            __DIR__.'/../../vendor/provision/media-manager/resources/views' => resource_path('views/vendor/media-manager'),
        ],'media-manager');
        $this->publishes([
            __DIR__.'/../../vendor/provision/media-manager/resources/lang' => resource_path('lang/vendor/media-manager/en'),
        ],'media-manager');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang/vendor/media-manager', 'media-manager');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang/vendor/administration', 'administration-lang');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
