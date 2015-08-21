# Caffeine For Laravel 5.1
## Goal
Prevent forms from timing out when submitting them after leaving them on-screen for a considerable amount of time.
(Laravel defaults to 120 minutes, but that is configurable and could be different site-by-site.)

## Implementation
To achieve this, we are sending a caffeine-drip (a request at regular intervals) to keep the session from timing out.
This is only implemented on pages with a `_token` field, so all other pages will time-out as normal.

## Reasoning
I chose this approach to keep the integrity of site-security, by avoiding the following:
- exposing the CSRF Token on an unsecured endpoint.
- eliminating CSRF Token validation on specific routes, or even altogether.
- removing session-timeout on all pages.

## Considerations
This package adds the routes under `genealabs/laravel-caffeine`. Please verify that these don't collide with your 
existing routes.

## Installation
1. Install caffeine via composer:
  ```sh
  composer require genealabs/laravel-caffeine:~0.1
  ```

2. Add the service provider entry in `config\app.php`:
  ```php
          GeneaLabs\LaravelCaffeine\LaravelCaffeineServiceProvider::class,
  ```

3. Publish the assets for this package:
  ```sh
  php artisan vendor:publish --tag=genealabs-laravel-caffeine --force
  ```

4. Register the middleware class in `app/Http/kernel.php`:
  ```php
      protected $middleware = [
          // other entries above
          \GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware::class,
	];
  ```

## Usage
That was it! It will apply itself automatically where it finds a form
with a `_token` field while pages are open in browsers.
