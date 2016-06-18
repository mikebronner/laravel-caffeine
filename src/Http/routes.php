<?php

use GeneaLabs\LaravelCaffeine\Helper;
use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');

if ((new Helper())->routeHasMiddlewareGroup('web')) {
    Route::group(['middleware' => ['web']], function () use ($dripRoute) {
        Route::get($dripRoute, LaravelCaffeineController::class.'@drip');
    });
} else {
    Route::get($dripRoute, LaravelCaffeineController::class.'@drip');
}
