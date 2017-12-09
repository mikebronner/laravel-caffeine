<?php

return [
    'dripIntervalInMilliSeconds' => 300000,         // Drip every 5 minutes
    'domain' => null,                               // defaults to url('/')
    'route' => 'genealabs/laravel-caffeine/drip',   // Can be customized
    'thresholdDifference' => 10000,                 // When the drip will be considered old to reload the page
    'checkLastDripInterval' => 2000                 // How often we will check if the drip is old
];
