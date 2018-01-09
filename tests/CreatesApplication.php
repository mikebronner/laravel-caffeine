<?php namespace GeneaLabs\LaravelCaffeine\Tests;

use GeneaLabs\LaravelCaffeine\Providers\Service as LaravelCaffeineService;

trait CreatesApplication
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [LaravelCaffeineService::class];
    }
}
