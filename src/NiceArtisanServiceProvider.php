<?php

namespace FFogarasi\NiceArtisan;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class NiceArtisanServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Get namespace
        $nameSpace = $this->app->getNamespace();

        // Set namespace alias for NiceArtisanController
        AliasLoader::getInstance()->alias('AppController', $nameSpace . 'Http\Controllers\Controller');

        // Set namespace alias for Kernel
        AliasLoader::getInstance()->alias('AppKernel', $nameSpace . 'Http\Kernel');

        // Routes
        $this->app->router->group(['namespace' => $nameSpace . 'Http\Controllers'], function()
        {
            require __DIR__.'/Http/routes.php';
        });

        // Views
        $this->loadViewsFrom(__DIR__.'/../views', 'NiceArtisan');
        
        // Config
        $this->publishes([
            __DIR__ . '/../config/commands.php' => config_path('commands.php'),
            __DIR__ . '/../config/nice-artisan.php' => config_path('nice-artisan.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(){}

}