<?php

use GeneaLabs\LaravelCaffeine\Helper;
use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

if ((new Helper())->routeHasMiddlewareGroup('web')) {
    Route::group(['middleware' => ['web']], function () {
        Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
    });
} else {
    Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
}
