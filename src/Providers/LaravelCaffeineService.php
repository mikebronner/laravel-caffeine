<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelCaffeineService extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $router = new Route();

        if (! $this->app->routesAreCached()) {
            $router::group([
                'middleware' => $this->middlewareGroupIfExists('web'),
            ], function () {
                require __DIR__ . '/../../routes/web.php';
            });
        }

        $this->publishes([__DIR__ . '/../../config/genealabs-laravel-caffeine.php' => config_path('genealabs-laravel-caffeine.php')], 'genealabs-laravel-caffeine');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/genealabs-laravel-caffeine.php', 'genealabs-laravel-caffeine');
        app('Illuminate\Contracts\Http\Kernel')->pushMiddleware(LaravelCaffeineDripMiddleware::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['genealabs-laravel-caffeine'];
    }

    private function middlewareGroupIfExists(string $group) : string
    {
        $routes = collect(Route::getRoutes()->getRoutes());

        return $routes->reduce(function ($carry, $route) use ($group) {
            $actions = (array) $route->getAction();

            if (array_key_exists('middleware', $actions)
                && in_array($group, (array) $actions['middleware'])
            ) {
                return $group;
            }

            return $carry;
        });
    }
}
