<?php namespace GeneaLabs\LaravelCaffeine\Tests;

use GeneaLabs\LaravelCaffeine\Providers\Service as LaravelCaffeineService;

trait CreatesApplication
{
    protected function getPackageProviders($app)
    {
        return [LaravelCaffeineService::class];
    }
}
