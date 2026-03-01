<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\Drip;
use Illuminate\Support\Facades\Route;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');

Route::get($dripRoute, Drip::class.'@drip')->middleware('web');
