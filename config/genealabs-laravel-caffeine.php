<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Drip Interval
    |--------------------------------------------------------------------------
    |
    | Here you may configure the interval with which Caffeine for Laravel
    | keeps the session alive. By default this is 5 minutes (expressed
    | in milliseconds). This needs to be shorter than your session
    | lifetime value configured set in "config/session.php".
    |
    | Default: 300000 (int)
    |
    */
    'drip-interval' => 300000,

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    |
    | You may optionally configure a separate domain that you are running
    | Caffeine for Laravel on. This may be of interest if you have a
    | monitoring service that queries other apps. Setting this to
    | null will use the domain of the current application.
    |
    | Default: null (null|string)
    |
    */
    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Drip Endpoint URL
    |--------------------------------------------------------------------------
    |
    | Sometimes you may wish to white-label your app and not expose the AJAX
    | request URLs as belonging to this package. To achieve that you can
    | rename the URL used for dripping caffeine into your application.
    |
    | Default: 'genealabs/laravel-caffeine/drip' (string)
    |
    */
    'route' => 'genealabs/laravel-caffeine/drip', // Customizable end-point URL

    /*
    |--------------------------------------------------------------------------
    | Checking for Lapsed Drips
    |--------------------------------------------------------------------------
    |
    | If the browser is put to sleep on (for example on mobil devices or
    | laptops), it will still cause an error when trying to submit the
    | form. To avoid this, we force-reload the form 2 minutes prior
    | to session time-out or later. Setting this setting to 0
    | will disable this check if you don't want to use it.
    |
    | Default: 2000 (int)
    |
    */
    'outdated-drip-check-interval' => 2000,

    /*
    |--------------------------------------------------------------------------
    | Use Route Middleware
    |--------------------------------------------------------------------------
    |
    | Drips are enabled via route middleware instead of global middleware.
    |
    | Default: false (bool)
    |
    */
    'use-route-middleware' => false,

];
