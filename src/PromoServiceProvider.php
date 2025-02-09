<?php

namespace Fintech\Promo;

use Fintech\Core\Traits\Packages\RegisterPackageTrait;
use Fintech\Promo\Commands\InstallCommand;
use Fintech\Promo\Providers\RepositoryServiceProvider;
use Illuminate\Support\ServiceProvider;

class PromoServiceProvider extends ServiceProvider
{
    use RegisterPackageTrait;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->packageCode = 'promo';

        $this->mergeConfigFrom(
            __DIR__.'/../config/promo.php', 'fintech.promo'
        );

        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->injectOnConfig();

        $this->publishes([
            __DIR__.'/../config/promo.php' => config_path('fintech/promo.php'),
        ], 'fintech-promo-config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'promo');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/promo'),
        ], 'fintech-promo-lang');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'promo');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/promo'),
        ], 'fintech-promo-views');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
