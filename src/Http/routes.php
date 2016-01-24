<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

Route::group(['middleware' => ['web']], function () {
    Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
});
