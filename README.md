# Composer package repository skeleton

This is a skeleton project for PHP based Composer package repositories.

## Table of contents

* [Features overview](#features-overview)
* [Requirements](#requirements)
* [Installation](#installation)
* [Configuration](#configuration)
* [Usage example](#usage-example)
    - [Usage under Windows](#usage-under-windows)
    - [Usage under Linux](#usage-under-linux)
* [Unit testing with PHPUnit](#unit-testing-with-phpunit)
* [Known Bugs](#known-bugs)
* [Contributing](#contributing)
* [Credits](#credits)
* [Donation](#donation)
* [License](#license)

## Features overview

* DRY concept
* Unit testing with [PHPUnit](https://phpunit.de/)
** CLI commands with [Symphony Console Component][symfony-console]

## Requirements

The following versions of PHP are supported by this version.

* PHP 5.5
* PHP 5.6
* HHVM

## Installation

https://packagist.org/packages/shakahl/skeleton-composer-project

Add `shakahl/skeleton-composer-project` as a requirement to `composer.json`:

```json
{
    "require": {
        "shakahl/skeleton-composer-project": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

You can also add the package using `composer require shakahl/skeleton-composer-project` and later specifying the version you want (for now, `dev-master` is your best bet).

## Configuration

Not any :)

## Usage example

```php
<?php
// Example code for usage...
?>
```

## Unit testing with PHPUnit

Make sure about all composer dependencies are installed already.
```shell
$ composer install
```

### Usage under Windows
```shell
$ vendor/bin/phpunit​.bat
```

### Usage under Linux
```shell
$ vendor/bin/phpunit
```

## Known Bugs

There aren't any known issues yet.

## Contributing

See `CONTRIBUTING.md` file.

## Credits

This package was originally created by [Soma Szélpál][shakahl].

## Donation

You can support [contributors][contributors] of this project individually. Every contributor is welcomed to add his/her line below with any content. Ordering shall be alphabetically by GitHub username.

* [@shakahl](https://github.com/shakahl): <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=3PWPWKLHMBSCU&lc=US&item_name=Open%20Source%20Development&item_number=opensource&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="[paypal]" /></a>

## License

This project is released under the [MIT License][opensource].

[shakahl]: https://github.com/shakahl/
[contributors]: https://github.com/shakahl/skeleton-composer-project/graphs/contributors
[opensource]: http://www.opensource.org/licenses/MIT
[symfony-console]: http://symfony.com/doc/current/components/console/introduction.html
