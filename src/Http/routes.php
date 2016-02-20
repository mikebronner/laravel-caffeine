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
        if (in_array('web', $route->getAction()['middleware'])) {
            return true;
        }
    }

    return false;
}
