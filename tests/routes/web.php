<?php

Route::group([
    'middleware' => ['web'],
    'as' => 'genealabs-laravel-caffeine.',
    'prefix' => 'tests',
    'namespace' => 'GeneaLabs\LaravelCaffeine\Tests\Http\Controllers',
], function () {
    Route::any('form', 'Test@drippedForm')
        ->name('tests.form');
    Route::any('dripped-form', 'Test@drippedForm');
    Route::any('expiring-form', 'Test@expiredForm');
    Route::any('disabled-page', 'Test@disabledPage')
        ->name('tests.disabled-page');
    Route::any('null-response', 'Test@nullResponse')
        ->name('tests.null-response');
    Route::any('route-middleware', 'Test@drippedForm')
        ->name('tests.route-middleware')
        ->middleware('caffeinated');
});
