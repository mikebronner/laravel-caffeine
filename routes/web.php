<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\Drip;
use GeneaLabs\LaravelCaffeine\Http\Controllers\Test;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
Route::get($dripRoute, Drip::class.'@drip');

Route::group(['prefix' => 'tests'], function () {
    Route::any('dripped-form', Test::class . '@drippedForm');
    Route::any('expiring-form', Test::class . '@expiredForm');
});
