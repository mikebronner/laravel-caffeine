<?php

use GeneaLabs\LaravelCaffeine\Http\Controllers\Drip;
use GeneaLabs\LaravelCaffeine\Http\Controllers\Test;

$dripRoute = config('genealabs-laravel-caffeine.route', 'genealabs/laravel-caffeine/drip');
Route::get($dripRoute, Drip::class.'@drip');

Route::group([
    'middleware' => ['web'],
    'as' => 'genealabs-laravel-caffeine.',
    'prefix' => 'tests'
], function () {
    Route::any('form', Test::class . '@drippedForm')
        ->name('tests.form');
    Route::any('dripped-form', Test::class . '@drippedForm');
    Route::any('expiring-form', Test::class . '@expiredForm');
    Route::any('disabled-page', Test::class . '@disabledPage')
        ->name('tests.disabled-page');
});
