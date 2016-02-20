<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

if (hasWebMiddleware()) {
    Route::group(['middleware' => ['web']], function () {
        Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
    });
} else {
    Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
}

function hasWebMiddleware()
{
    $routes = Route::getRoutes()->getRoutes();

    foreach ($routes as $route) {
        $actions = (array) $route->getAction();

        if (array_key_exists('middleware', $actions)
            && in_array('web', $actions['middleware'])
        ) {
            return true;
        }
    }

    return false;
}
