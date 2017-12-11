<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\Drip;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');

Route::get($dripRoute, Drip::class.'@drip');
