<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

if (isset(Route::getMiddleware()['web'])) {
    Route::group(['middleware' => ['web']], function () {
        Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
    });
} else {
    Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
}
