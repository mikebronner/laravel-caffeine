<?php

return [
    /**
     * Interval in which the drip AJAX request will run, provided in milliseconds.
     *
     * Default: 5 minutes
     */
    'dripIntervalInMilliSeconds' => 300000,

    /**
     * Change to point to a different domain than your app. This is useful if you are behind a proxy or load-balancer.
     *
     * Default: url('/')
     */
    'domain' => null,

    /**
     * Change to customize the drip URL in the browser. This is just cosmetic.
     */
    'route' => 'genealabs/laravel-caffeine/drip',

    /**
     * Change to set the middleware for the drip route to be grouped into. Defaults to web if web exists, otherwise
     * it is not grouped.
     */
    'middleware' => null,
];
