<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use Illuminate\Config\Repository as Cache;
use Illuminate\Support\ServiceProvider;

class LaravelCaffeineService extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        app('router')->group($this->getRouteGroupOptions(), function () {
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

    /**
     * If the programmer defined something other than null in the configuration file we will use their config.
     * Otherwise we will check if the web middleware exists, if not we will have no middleware.
     *
     * @return array
     */
    protected function getRouteGroupOptions() : array
    {
        $middleware_config = app(Cache::class)->get('genealabs-laravel-caffeine.middleware');

        if ($middleware_config) {
            return ['middleware' => $middleware_config];
        }

        return $this->middlewareGroupExists('web') ? ['middleware' => 'web'] : [];
    }

    protected function middlewareGroupExists(string $group) : bool
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
