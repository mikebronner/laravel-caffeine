# Caffeine for Laravel
[![Travis](https://img.shields.io/travis/GeneaLabs/laravel-caffeine.svg)](https://travis-ci.org/GeneaLabs/laravel-caffeine)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/GeneaLabs/laravel-caffeine.svg)](https://scrutinizer-ci.com/g/GeneaLabs/laravel-caffeine)
[![Coveralls](https://img.shields.io/coveralls/GeneaLabs/laravel-caffeine.svg)](https://coveralls.io/github/GeneaLabs/laravel-caffeine)
[![GitHub (pre-)release](https://img.shields.io/github/release/GeneaLabs/laravel-caffeine/all.svg)](https://github.com/GeneaLabs/laravel-caffeine)
[![Packagist](https://img.shields.io/packagist/dt/GeneaLabs/laravel-caffeine.svg)](https://packagist.org/packages/genealabs/laravel-caffeine)

![Caffeine for Laravel masthead image.](https://repository-images.githubusercontent.com/40729869/26446500-f1b2-11e9-9611-6a2e65688de2)

## Supporting This Package
This is an MIT-licensed open source project with its ongoing development made possible by the support of the community. If you'd like to support this, and our other packages, please consider [becoming a sponsor](https://github.com/sponsors/mikebronner).

We thank the following sponsors for their generosity. Please take a moment to check them out:

- [LIX](https://lix-it.com)

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
### Incompatible Packages
- [Voyager](https://github.com/the-control-group/voyager) has been reported as
    being incompatible. To work around this, configure Caffeine to use
    route-based middleware on all non-Voyager routes. See details below for
    configuration and implementation of route-based middleware.

### Routes
This package adds the routes under `genealabs/laravel-caffeine`.

### Dependencies
Your project must fullfill the following:
- Laravel 8.0 or higher
- PHP 7.3 or higher.

## Installation
```sh
composer require genealabs/laravel-caffeine
```

## Upgrade Notes
If you have previously registered the middleware, please remove the following
   middleware from `app/Http/Kernel.php`:
   ```php
   // protected $middleware = [
       GeneaLabs\LaravelCaffeine\Http\Middleware\LaravelCaffeineDripMiddleware::class,
   // ];
   ```

### 0.6.0
This update changes the config file setting names. Please delete the published
config file `config/genealabs-laravel-caffeine.php` if it exists, and follow the
configuration instructions below.

## Configuration
```php
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
    | If the browser is put to sleep on (for example on mobile devices or
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
```

___Only publish the config file if you need to customize it___:
```sh
php artisan caffeine:publish --config
```

## Usage
That was it! It will apply itself automatically where it finds a form with a
`_token` field, or a meta tag named "csrf-token", while pages are open in
browsers.

### Prevent Caffeination
There are two methods to prevent Caffeine for Laravel from dripping to keep the
session alive: disabling it in Blade using the meta tag method, or enabling
route-middleware mode, and then only enabling it on routes or route groups.

#### Meta Tag Method
If you would like to prevent a certain page from caffeinating your application,
then add the following meta tag:
```php
<meta name="caffeinated" content="false">
```

#### Route Middleware Method
To enable this mode, you need to publish the configuration file (see the
configuration section above) and then set `use-route-middleware` to `true`. This
will disable the default global middleware mode (which applies it to any page
that has the CSRF token in it across your entire application). Now you need to
selectively enable Caffeine on a given route or route group using route
middleware:

```php
Route::any('test', 'TestController@test')->middleware('caffeinated');

Route::group(['middleware' => ['caffeinated']], function () {
    Route::any('test', 'TestController@test');
})
```

You can still use the route middleware method and apply it globally to all
routes by editing `app/Http/Kernel.php` and adding it to the `web` middleware
group. Although you should only use this option if you have a very specific use-
case that prevents you from utilizing the default global middleware option.

__This will only have effect if the page includes a form. If not, the page will
not caffeinate your application anyway.__

# The Fine Print
## Commitment to Quality
During package development I try as best as possible to embrace good design and
development practices to try to ensure that this package is as good as it can
be. My checklist for package development includes:

-   ✅ Achieve as close to 100% code coverage as possible using unit tests.
-   ✅ Eliminate any issues identified by SensioLabs Insight and Scrutinizer.
-   ✅ Be fully PSR1, PSR2, and PSR4 compliant.
-   ✅ Include comprehensive documentation in README.md.
-   ✅ Provide an up-to-date CHANGELOG.md which adheres to the format outlined
    at <https://keepachangelog.com>.
-   ✅ Have no PHPMD or PHPCS warnings throughout all code.

## Contributing
Please observe and respect all aspects of the included Code of Conduct
<https://github.com/GeneaLabs/laravel-caffeine/blob/master/CODE_OF_CONDUCT.md>.

### Reporting Issues
When reporting issues, please fill out the included template as completely as
possible. Incomplete issues may be ignored or closed if there is not enough
information included to be actionable.

### Submitting Pull Requests
Please review the Contribution Guidelines <https://github.com/GeneaLabs/laravel-caffeine/blob/master/CONTRIBUTING.md>.
Only PRs that meet all criterium will be accepted.

## ❤️ Open-Source Software - Give ⭐️
We have included the awesome `symfony/thanks` composer package as a dev
dependency. Let your OS package maintainers know you appreciate them by starring
the packages you use. Simply run `composer thanks` after installing this
package. (And not to worry, since it's a dev-dependency it won't be installed in
your live environment.)
