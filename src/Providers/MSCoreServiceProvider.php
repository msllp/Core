<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 12-03-2019
 * Time: 03:03 AM
 */

namespace MS\Provider;


class MSCoreServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'MS');

        $this->loadViewsFrom(__DIR__ . '/Views', 'MS');

        $this->publishes([
            __DIR__ . '/Config/MS.php' => base_path('config/MS.php'),
        ], 'MS_config');

        if(config('MS.default_route_load')){

        }

    }
}