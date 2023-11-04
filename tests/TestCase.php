<?php

namespace Fintech\Promo\Tests;

use Fintech\Promo\PromoServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PromoServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.env', 'testing');
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_promo_table.php.stub';
        $migration->up();
        */
    }
}
