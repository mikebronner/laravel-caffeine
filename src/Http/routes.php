<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\LaravelCaffeineController;

Route::get('genealabs/laravel-caffeine/drip', LaravelCaffeineController::class . '@drip');
