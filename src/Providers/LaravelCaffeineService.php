<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use Illuminate\Support\ServiceProvider;

class LaravelCaffeineService extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        app('router')->group($this->middlewareGroupExists('web')
            ? ['middleware' => 'web']
            : [], function () {
                require __DIR__ . '/../../routes/web.php';
            });

        $this->publishes([__DIR__ . '/../../config/genealabs-laravel-caffeine.php' => config_path('genealabs-laravel-caffeine.php')], 'genealabs-laravel-caffeine');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/genealabs-laravel-caffeine.php', 'genealabs-laravel-caffeine');

        app('Illuminate\Contracts\Http\Kernel')->pushMiddleware('\GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware');
    }

    public function provides() : array
    {
        return ['genealabs-laravel-caffeine'];
    }

    private function middlewareGroupExists(string $group) : bool
    {
        $routes = collect(app('router')->getRoutes()->getRoutes());

        return $routes->reduce(function ($carry, $route) use ($group) {
            $carry = ($carry ?? false) ?: false;
            $actions = (array) $route->getAction();

            if (array_key_exists('middleware', $actions)
                && in_array($group, (array) $actions['middleware'])
            ) {
                return true;
            }

            return $carry;
        }) ?? false;
    }
}
