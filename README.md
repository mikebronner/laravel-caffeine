![Coffee for Laravel](https://github.com/GeneaLabs/laravel-caffeine/blob/master/caffeine.jpg)

## Goal
Prevent forms from timing out when submitting them after leaving them on-screen
 for a considerable amount of time. (Laravel defaults to 120 minutes, but that
 is configurable and could be different site-by-site.)

## Implementation
To achieve this, we are sending a caffeine-drip (a request at regular intervals)
 to keep the session from timing out.
This is only implemented on pages with a `_token` field, so all other pages will
 time-out as normal.

## Reasoning
I chose this approach to keep the integrity of site-security, by avoiding the
 following:
- exposing the CSRF Token on an unsecured endpoint.
- eliminating CSRF Token validation on specific routes, or even altogether.
- removing session-timeout on all pages.

## Considerations
### Routes
This package adds the routes under `genealabs/laravel-caffeine`. Please verify
 that these don't collide with your existing routes.

### Dependencies
- Your project must be running Laravel 5.1 (LTS) or 5.3 (CURRENT).
- PHP 7.0.0 or higher.

## Installation
1. Installation for Laravel LTS or CURRENT:
   ```sh
   composer require genealabs/laravel-caffeine
   ```

   For Laravel 5.2:
   ```sh
   composer require genealabs/laravel-caffeine:~0.3.11
   ```

2. Add the service provider entry in `config\app.php`:
   ```php
           GeneaLabs\LaravelCaffeine\LaravelCaffeineServiceProvider::class,
   ```

3. You no longer have to register the middleware manually. If you have done so
   previously, please remove the following middleware from `/app/Http/Kernel.php`:
   ```php
//       protected $middleware = [
           \GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware::class,
//       ];
   ```

## Configuration
The following elements are configurable:
- **domain:** (default: `url('/')`) Change to point to a different domain than
 your app. This is useful if you are behind a proxy or load-balancer. ___Do not use
 the `url()` helper in the config file.___
- **route:** (default: `genealabs/laravel-caffeine/drip`) Change to customize
 the drip URL in the browser. This is just cosmetic.
- **dripIntervalInMilliSeconds:** (default: 5 mins) Change to configure the drip
 interval.
- **middleware:** (default: NULL|web) Change to set the middleware for the drip route to be grouped into.
 Defaults to web if web exists, otherwise it is not grouped.

___Only publish the config file it you need to customize it___:
```sh
php artisan vendor:publish --tag=genealabs-laravel-caffeine
```

You can now change the default value in `/app/config/genealabs-laravel-caffeine.php` as desired. Deleting the
`/app/config/genealabs-laravel-caffeine.php` file will revert back to the default settings.

## Usage
That was it! It will apply itself automatically where it finds a form with a `_token` field, or a meta tag named
 "csrf-token", while pages are open in browsers.
