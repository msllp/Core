<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 12-03-2019
 * Time: 03:03 AM
 */

namespace MS\Provider;
define('DS',DIRECTORY_SEPARATOR);

class MSCoreServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(  dirname(__DIR__) .DS.'Lang', 'MS');

        $this->loadViewsFrom(  dirname(__DIR__) .DS.'Views', 'MS');

        $this->publishes([
            dirname(__DIR__) .DS.'Config'.DS.'MS.php' => base_path('config/MS.php'),
        ], 'MS_config');



        $this->publishes([
            dirname(__DIR__).DS.'MSDB' => base_path('MS/DB/Master')
        ], 'MS_db');
        $this->publishes([
            dirname(__DIR__) .DS.'Public'.DS.'B'.DS.'asset' => public_path(),
        ], 'public_backend');

        $this->publishes([
            dirname(__DIR__).DS.'Routes'.DS.'MasterRoutes.php' => base_path('routes/web.php')
        ], 'MS_Master_Routes');

        $this->publishes([
            dirname(__DIR__).DS.'Routes'.DS.'ModuleRoutes.php' => base_path('MS/B/M/Routes.php')
        ], 'MS_Backend_Routes');

        $this->publishes([
            dirname(__DIR__).DS.'Routes'.DS.'ModuleRoutes.php' => base_path('MS/F/M/Routes.php')
        ], 'MS_Frontend_Routes');


        $this->publishes([
            dirname(__DIR__).DS.'Middlelwares'.DS.'settingOn.php' => base_path('app/Http/Middleware/settingOn.php')
        ], 'MS_SettingOn_Config');


        $this->publishes([
            dirname(__DIR__) .DS.'Core'.DS.'Template'.DS.'webpack.mix.js' => base_path('webpack.mix.js'),
        ], 'webpack');

        $this->publishes([
            dirname(__DIR__) .DS.'Core'.DS.'Template'.DS.'bower.json' => base_path('bower.js'),
        ], 'bower');

        $this->publishes([
            dirname(__DIR__) .DS.'Core'.DS.'Template'.DS.'gulpfile.js' => base_path('gulpfile.js'),
        ], 'gulp');






        if(config('MS.default_route_load')){



        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                \MS\Core\Console\Master::class,
                \MS\Core\Console\GenMod::class,
                \MS\Core\Console\Git::class,
            ]);
        }



    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        define("MSCORE_UI_STATUS_1","B\MAS:CORE_UI_Status_1:StatusBoolean->StatusName");

        $this->mergeConfigFrom(
            dirname(__DIR__).DS.'Config/Auth.php', base_path('config/auth.php')
        );



      //  \Config::set('app.url','http://hdtuto.com/');
      //  dd(dirname(__DIR__));
        $this->mergeConfigFrom(
            dirname(__DIR__).DS.'Config/Filesystem.php', 'filesystems.disks'
        );
    }
}
