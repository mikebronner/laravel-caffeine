<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

Route::get(config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip'), LaravelCaffeineController::class . '@drip');
