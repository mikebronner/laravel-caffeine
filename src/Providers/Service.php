<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use GeneaLabs\LaravelCaffeine\Console\Commands\Publish;
use GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    public function boot()
    {
        app('router')->group(app("router")->hasMiddlewareGroup('web')
            ? ['middleware' => 'web']
            : [], function () {
                require __DIR__ . '/../../routes/web.php';

                if (config("app.env") === 'internaltesting') {
                    require __DIR__ . '/../../tests/routes/web.php';
                }
            });

        $configPath = __DIR__ . '/../../config/genealabs-laravel-caffeine.php';
        $this->mergeConfigFrom($configPath, 'genealabs-laravel-caffeine');
        $this->loadViewsFrom(
            __DIR__ . '/../../resources/views',
            'genealabs-laravel-caffeine'
        );

        if (config("app.env") === 'internaltesting') {
            $this->loadViewsFrom(
                __DIR__ . '/../../tests/resources/views',
                'genealabs-laravel-caffeine'
            );
        }

        $this->publishes([
            $configPath => config_path('genealabs-laravel-caffeine.php')
        ], 'config');

        $this->commands(Publish::class);
        $this->mergeConfigFrom(__DIR__ . '/../../config/genealabs-laravel-caffeine.php', 'genealabs-laravel-caffeine');

        if ($this->shouldRegisterGlobalMiddleware()) {
            app(Kernel::class)->pushMiddleware('\\' . LaravelCaffeineDripMiddleware::class);
        }

        if ($this->shouldRegisterRouteMiddleware()) {
            app('router')->aliasMiddleware(
                'caffeinated',
                '\\' . LaravelCaffeineDripMiddleware::class
            );
        }
    }

    protected function shouldRegisterGlobalMiddleware() : bool
    {
        return (! request()->ajax()
            && ! $this->shouldRegisterRouteMiddleware()
            && (php_sapi_name() === 'fpm-fcgi'
                || php_sapi_name() === 'cgi-fcgi'
                || php_sapi_name() === 'apache2handler'
                || php_sapi_name() === 'litespeed'
                || php_sapi_name() === 'cli-server'
                || config("app.env") === 'internaltesting'));
    }

    protected function shouldRegisterRouteMiddleware() : bool
    {
        return (bool) config('genealabs-laravel-caffeine.use-route-middleware');
    }
}
