<?php

namespace Imynely\Pay;

use Imynely\Pay\PaymentManager;

use Illuminate\Support\ServiceProvider;

class PayServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'imynely');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'imynely');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('pay', function ($app) {
            return new PaymentManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pay'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/payments.php' => config_path('payments.php'),
        ]);

        // publiching migrations 

        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('database/migrations'),
        ]);

        // publiching models

        $this->publishes([
            __DIR__ . '/../models/' => base_path('app'),
        ]);

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/imynely'),
        ], 'pay.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/imynely'),
        ], 'pay.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/imynely'),
        ], 'pay.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
