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

        $this->publishes([__DIR__ . '/../config/genealabs-laravel-caffeine.php' => config_path('genealabs-laravel-caffeine.php')], 'genealabs-laravel-caffeine');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/genealabs-laravel-caffeine.php', 'genealabs-laravel-caffeine');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['genealabs-laravel-caffeine'];
    }
}
