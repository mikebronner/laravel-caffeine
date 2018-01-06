# Change Log
## [0.6.5] - 11 Dec 2017
### Added
- `thanks` package.

### Updated
- documentation and change-log.

## [0.6.4] - 11 Dec 2017
### Fixed
- composer dependency version constraints (only Laravel 5.4 and 5.5 have been tested).

## [0.6.3] - 11 Dec 2017
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
