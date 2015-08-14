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

        $this->publishes([__DIR__ . '/public' => public_path('genealabs/laravel-caffeine')], 'genealabs-laravel-caffeine');
    }

    public function register()
    {

    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['laravel-caffein'];
    }
}
