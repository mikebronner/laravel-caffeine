# ☕ Caffeine for Laravel

[![GitHub Actions](https://img.shields.io/github/actions/workflow/status/GeneaLabs/laravel-caffeine/laravel.yml?branch=master)](https://github.com/GeneaLabs/laravel-caffeine/actions)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/GeneaLabs/laravel-caffeine.svg)](https://scrutinizer-ci.com/g/GeneaLabs/laravel-caffeine)
[![GitHub (pre-)release](https://img.shields.io/github/release/GeneaLabs/laravel-caffeine/all.svg)](https://github.com/GeneaLabs/laravel-caffeine)
[![Packagist](https://img.shields.io/packagist/dt/GeneaLabs/laravel-caffeine.svg)](https://packagist.org/packages/genealabs/laravel-caffeine)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/GeneaLabs/laravel-caffeine/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/genealabs/laravel-caffeine)](https://packagist.org/packages/genealabs/laravel-caffeine)
[![Laravel](https://img.shields.io/badge/Laravel-11%20%7C%2012%20%7C%2013-FF2D20)](https://laravel.com)
[![GitHub Stars](https://img.shields.io/github/stars/GeneaLabs/laravel-caffeine)](https://github.com/GeneaLabs/laravel-caffeine/stargazers)

![Caffeine for Laravel masthead image.](https://repository-images.githubusercontent.com/40729869/26446500-f1b2-11e9-9611-6a2e65688de2)

## 🗂️ Table of Contents
- [📖 Summary](#-summary)
- [📦 Installation](#-installation)
- [⚙️ Configuration](#️-configuration)
- [🚀 Usage](#-usage)
- [⚠️ Considerations](#️-considerations)
- [⬆️ Upgrading](#️-upgrading)
- [🤝 Contributing](#-contributing)
- [🔐 Security](#-security)

## 📖 Summary
Prevent forms from timing out when submitting them after leaving them on-screen
for a considerable amount of time. Laravel defaults session lifetime to 120
minutes, but that is configurable and could be different site-by-site.

☕ Caffeine works by sending a "drip" — a lightweight AJAX request at regular
intervals — to keep the session alive while a form is open. It only activates on
pages with a `_token` field or a `csrf-token` meta tag, so all other pages
time-out as normal.

### 🔒 Why This Approach?
This package keeps the integrity of your site's security by avoiding the
following:
- 🚫 Exposing the CSRF Token on an unsecured endpoint.
- 🚫 Eliminating CSRF Token validation on specific routes, or altogether.
- 🚫 Removing session-timeout on all pages.

### 📋 Requirements
- PHP 8.2+
- Laravel 11, 12, or 13

| Laravel | PHP  | Package |
|---------|------|---------|
| 11.x    | 8.2+ | 12.x   |
| 12.x    | 8.2+ | 12.x   |
| 13.x    | 8.4+ | 12.x   |

## 📦 Installation
```sh
composer require genealabs/laravel-caffeine
```

✨ The service provider is auto-discovered. No additional setup is required.

## ⚙️ Configuration
___Only publish the config file if you need to customize it___:
```sh
php artisan caffeine:publish --config
```

This creates the following config file:

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
    'route' => 'genealabs/laravel-caffeine/drip',

    /*
    |--------------------------------------------------------------------------
    | Checking for Lapsed Drips
    |--------------------------------------------------------------------------
    |
    | If the browser tab is suspended due to inactivity or the device is put to
    | sleep, it will still cause an error when trying to submit the form. To
    | avoid this, we force-reload the form 2 minutes prior to session
    | time-out or later. Setting this setting to 0 will disable this
    | check if you don't want to use it.
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

## 🚀 Usage
That's it! It will apply itself automatically where it finds a form with a
`_token` field, or a meta tag named "csrf-token", while pages are open in
browsers. 🎉

### 🚫 Prevent Caffeination
There are two methods to prevent Caffeine from keeping the session alive:

#### 🏷️ Meta Tag Method
Add the following meta tag to any page you want to exclude:
```html
<meta name="caffeinated" content="false">
```

#### 🛣️ Route Middleware Method
Publish the config file and set `use-route-middleware` to `true`. This disables
the default global middleware mode. Then selectively enable Caffeine on specific
routes or route groups:

```php
Route::any('test', 'TestController@test')->middleware('caffeinated');

Route::middleware(['caffeinated'])->group(function () {
    Route::any('test', 'TestController@test');
});
```

> **📝 Note:** This will only have effect if the page includes a form. If not,
> the page will not caffeinate your application anyway.

## ⚠️ Considerations

### 🔌 Livewire / Inertia / SPA
This package works by injecting JavaScript that pings a keep-alive endpoint. It
is designed for traditional Blade forms. If you are using **Livewire** or
**Inertia**, their built-in request cycles typically keep the session alive
already, so this package is generally unnecessary in those contexts.

### 🚧 Incompatible Packages
- [Voyager](https://github.com/the-control-group/voyager) has been reported as
    being incompatible. To work around this, configure Caffeine to use
    route-based middleware on all non-Voyager routes.

### 🛤️ Routes
This package registers routes under `genealabs/laravel-caffeine`.

## ⬆️ Upgrading
### 0.6.0
This update changed the config file setting names. Delete the published config
file `config/genealabs-laravel-caffeine.php` if it exists, and re-publish using
the command in the [Configuration](#️-configuration) section.

For all other version changes, see the
[Releases](https://github.com/GeneaLabs/laravel-caffeine/releases) page on
GitHub.

## 🤝 Contributing
Contributions are welcome! 🎉 Please review the
[Contribution Guidelines](https://github.com/GeneaLabs/laravel-caffeine/blob/master/CONTRIBUTING.md)
and observe the
[Code of Conduct](https://github.com/GeneaLabs/laravel-caffeine/blob/master/CODE_OF_CONDUCT.md)
before submitting a pull request.

### 🧪 Quality Checklist
- ✅ Achieve as close to 100% code coverage as possible using unit tests.
- ✅ Be fully PSR-1, PSR-4, and PSR-12 compliant.
- ✅ Provide an up-to-date [CHANGELOG.md](CHANGELOG.md) adhering to
    [Keep a Changelog](https://keepachangelog.com).
- ✅ Have no PHPMD or PHPCS warnings throughout all code.

## 🔐 Security
If you discover a security vulnerability, please report it via
[GitHub Security Advisories](https://github.com/GeneaLabs/laravel-caffeine/security/advisories)
rather than opening a public issue.

---

<p align="center">
Built with ❤️ for the Laravel community using lots of ☕ by <a href="https://github.com/mikebronner">Mike Bronner</a>.
</p>

<p align="center">
This is an MIT-licensed open-source project. Its continued development is made
possible by the community. If you find it useful, please consider
<a href="https://github.com/sponsors/mikebronner">💖 becoming a sponsor</a>
and
<a href="https://github.com/GeneaLabs/laravel-caffeine">⭐ starring it on GitHub</a>.
</p>
