<?php

use GeneaLabs\LaravelCaffeine\Tests\Http\Controllers\Test;

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
    Route::any('null-response', Test::class . '@nullResponse')
        ->name('tests.null-response');
    Route::any('route-middleware', Test::class . '@drippedForm')
        ->name('tests.route-middleware')
        ->middleware('caffeinated');
});
