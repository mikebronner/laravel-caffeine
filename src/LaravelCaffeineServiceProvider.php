<?php namespace GeneaLabs\LaravelCaffeine;

use Illuminate\Support\ServiceProvider;

class LaravelCaffeineServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
    }

    public function register()
    {

    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['laravel-caffeine'];
    }
}
