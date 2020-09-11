# Change Log

## [7.0.2] - 2020-03-11
### Fixed
- problems with DOM parsing and reverted back to RegExp.

## [7.0.1] - 2020-03-06
### Updated
- dependencies for Laravel 7 compatibility, removed temp dependencies.

## [7.0.0] - 2020-02-29
### Added
- Laravel 7 compatibility.

### Fixed
- asset insertion functionality.

## [1.0.5] - 2019-11-28
### Updated
- readme with Voyager incompatibility warning and suggested work-around.

## [1.0.4] - 2019-10-08
### Fixed
- commits not being applied to previous release.

## [1.0.3] - 2019-10-08
### Updated
- dependency compatibilies.

## [1.0] - 2019-09-05
### Added
- Laravel 6.0 compatibility.

### Removed
- compatibility with older versions of Laravel.

## [0.8.3] - 2019-06-30
### Added
- support for Spatie's `laravel-csp` package.

## [0.8.2] - 2019-06-30
### Changed
- method of checking registered middleware groups to use `hasMiddlewareGroup()`.

## [0.6.12] - 5 Aug 2018
### Fixed
- middleware response to be a view instead of string. Thanks @dallincoons, #96 #95.

## [0.6.11] - 13 May 2018
### Fixed
- regexp to be simpler. Thanks @juandi, #92.
- `app_env` (to `internaltesting`) to avoid testing conflicts. Thanks @agjino, #82.

## [0.6.10] - 13 May 2018
### Fixed
- erroneous `const` in JavaScript, changed to `var`. Thanks @netpok, #86.

## [0.6.9] - 13 May 2018
### Fixed
- erroneous `let` in JavaScript, changed to `var`. Thanks @spaceemotion, #94.

## [0.6.8] - 15 Feb 2018
### Fixed
- dependency versions to allow installation on earlier versions of Laravel.

## [0.6.7] - 9 Feb 2018
### Added
- Laravel 5.6 compatibility.

## [0.6.6] - 9 Jan 2018
### Changed
- testing to use orchestral/testbench suite.

## [0.6.5] - 5 Jan 2018
### Added
- Laravel 5.6 compatibility.

## [0.6.6] - 9 Feb 2018
### Changed
- tests to use `orchestral/testbench` suite.

## [0.6.5] - 5 Jan 2018
### Added
- `thanks` package.

### Updated
- documentation and change-log.

## [0.6.4] - 5 Jan 2018
### Fixed
- composer dependency version constraints (only Laravel 5.4 and 5.5 have been tested).

## [0.6.3] - 14 Dec 2017
### Fixed
- middleware registration to detect apache server.

## [0.6.2] - 11 Dec 2017
### Added
- route middleware functionality.

### Changed
- config variable to `outdated-drip-check-interval`.

### Fixed
- naming of config setting `drip-interval`.
- formatting of script fixture.

## [0.6.1] - 10 Dec 2017
### Added
- ability to exclude a page from caffinating the application via meta tag.

## [0.6.0] - 9 Dec 2017
### Added
- drip timeout check and force page refresh if timeout occurred.

### Changed
- config file setting names to be more explicit.
- middleware is injected only when called from a web page or during testing.
