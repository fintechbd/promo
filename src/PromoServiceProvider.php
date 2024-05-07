<?php

namespace Fintech\Promo;

use Fintech\Core\Traits\RegisterPackageTrait;
use Fintech\Promo\Commands\InstallCommand;
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

        $this->app->register(\Fintech\Promo\Providers\RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->injectOnConfig();

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
                InstallCommand::class
            ]);
        }
    }
}
