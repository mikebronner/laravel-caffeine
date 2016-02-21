<?php namespace GeneaLabs\LaravelCaffeine;

use Illuminate\Support\Facades\Route;

class Helper
{
    public function routeHasMiddlewareGroup($group)
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            $actions = (array) $route->getAction();

            if (array_key_exists('middleware', $actions)
                && in_array($group, (array) $actions['middleware'])
            ) {
                return true;
            }
        }

        return false;
    }
}
