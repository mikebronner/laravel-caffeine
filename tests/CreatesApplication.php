<?php namespace GeneaLabs\LaravelCaffeine\Tests;

use GeneaLabs\LaravelCaffeine\Providers\Service as LaravelCaffeineService;

trait CreatesApplication
{
    protected function refreshApplication()
    {
        putenv('APP_ENV=internaltesting');

        $this->app = $this->createApplication();
    }
    
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [LaravelCaffeineService::class];
    }
}
