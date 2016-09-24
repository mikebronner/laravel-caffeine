<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
Route::get($dripRoute, LaravelCaffeineController::class.'@drip');
