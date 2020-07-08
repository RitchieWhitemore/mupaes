<?php

namespace Whitemore\Menu;

use Illuminate\Support\ServiceProvider;
use Whitemore\Menu\Controllers\MenuController;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(MenuController::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/Views', 'menu');

        $this->publishes([
            __DIR__ . '/resources' => public_path('vendor/menu'),
        ], 'public');
    }
}
