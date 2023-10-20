<?php

namespace Fintech\Promo;

use Fintech\Promo\Commands\InstallCommand;
use Fintech\Promo\Commands\PromoCommand;
use Illuminate\Support\ServiceProvider;

class PromoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/promo.php', 'fintech.promo'
        );

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/promo.php' => config_path('fintech/promo.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'promo');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/promo'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'promo');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/promo'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                PromoCommand::class,
            ]);
        }
    }
}
