<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use GeneaLabs\LaravelCaffeine\Console\Commands\Publish;
use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        app('router')->group($this->middlewareGroupExists('web')
            ? ['middleware' => 'web']
            : [], function () {
                require __DIR__ . '/../../routes/web.php';

                if (app('env') === 'testing') {
                    require __DIR__ . '/../../tests/routes/web.php';
                }
            });

        $configPath = __DIR__ . '/../../config/genealabs-laravel-caffeine.php';
        $this->mergeConfigFrom($configPath, 'genealabs-laravel-caffeine');
        $this->loadViewsFrom(
            __DIR__ . '/../../resources/views',
            'genealabs-laravel-caffeine'
        );

        if (app('env') === 'testing') {
            $this->loadViewsFrom(
                __DIR__ . '/../../tests/resources/views',
                'genealabs-laravel-caffeine'
            );
        }

        $this->publishes([
            $configPath => config_path('genealabs-laravel-caffeine.php')
        ], 'config');
    }

    public function register()
    {
        $this->commands(Publish::class);
        $this->mergeConfigFrom(__DIR__ . '/../../config/genealabs-laravel-caffeine.php', 'genealabs-laravel-caffeine');

        if ($this->shouldRegisterMiddleware()) {
            app(Kernel::class)->pushMiddleware('\\' . LaravelCaffeineDripMiddleware::class);
        }
    }

    public function provides() : array
    {
        return ['genealabs-laravel-caffeine'];
    }

    protected function middlewareGroupExists(string $group) : bool
    {
        $routes = collect(app('router')->getRoutes()->getRoutes());

        return $routes->reduce(function ($carry, Route $route) use ($group) {
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

    protected function shouldRegisterMiddleware() : bool
    {
        return (! request()->ajax()
            && (php_sapi_name() === 'fpm-fcgi' || app('env') === 'testing'));
    }
}
