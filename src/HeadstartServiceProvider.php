<?php

namespace ModernMcGuire\Headstart;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ModernMcGuire\Headstart\Middleware\Admin;

class HeadstartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'headstart');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'headstart');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/headstart'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/headstart'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/headstart'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'headstart-migrations');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/headstart'),
            ], 'headstart-assets');

            $this->publishes([
                __DIR__.'/../config/headstart.php' => config_path('headstart.php'),
            ], 'headstart-config');

            $this->publishes([
                __DIR__.'/../stubs/HeadstartServiceProvider.stub' => app_path('Providers/HeadstartServiceProvider.php'),
            ], 'headstart-provider');
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        // admin routes
        Route::group($this->adminRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/headstart-admin.php');
        });

        // public routes
        Route::group($this->publicRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/headstart.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function adminRouteConfiguration()
    {
        return [
            'domain' => config('headstart.domain', null),
            'prefix' => config('headstart.path'),
            'namespace' => 'ModernMcGuire\Headstart\Http\Controllers\Admin',
            'middleware' => 'headstart'
        ];
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function publicRouteConfiguration()
    {
        return [
            'domain' => config('headstart.domain', null),
            'prefix' => config('headstart.path'),
            'namespace' => 'ModernMcGuire\Headstart\Http\Controllers',
            'middleware' => 'web'
        ];
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('headstart', function () {
            return new Headstart;
        });
    }
}
