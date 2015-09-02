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

        $this->publishes([__DIR__ . '/../config/config.php' => config_path('genealabs-laravel-caffeine.php')], 'genealabs-laravel-caffeine');
    }

    public function register()
    {
        // Nothing to see here, folks ...
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['genealabs-laravel-caffeine'];
    }
}
