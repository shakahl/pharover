# Pharover

Command line tool to send push notifications through the [Pushover](http://pushover.com) service.

## Table of contents

* [Features overview](#features-overview)
* [Requirements](#requirements)
* [Installation](#installation)
* [Configuration](#configuration)
* [Usage example](#usage-example)
    - [Usage under Windows](#usage-under-windows)
    - [Usage under Linux](#usage-under-linux)
    - [Building](#building)
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

https://packagist.org/packages/shakahl/pharover

Add `shakahl/pharover` as a requirement to `composer.json`:

```json
{
    "require": {
        "shakahl/pharover": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

You can also add the package using `composer require shakahl/pharover` and later specifying the version you want (for now, `dev-master` is your best bet).

## Configuration

You must specify your Pullover API credentials in a `.pharover.json` file.

```json
{
    "user-key" : "",
    "token-key" : ""
}
```

The file can be placed:
* To your HOME directory.
* To the current working directory.
* To the directory containing the `pharover.phar`.

## Usage example

```bash
$ php pharover.phar notification:send "test message" --title="Pharover" --url="https://github.com/shakahl/pharover" --url-title="Pharover on GitHub"
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

### Building

Pharover can be built with the [Box2](http://box-project.github.io/box2/)

```bash
$ composer install --no-dev
$ box build
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
[contributors]: https://github.com/shakahl/pharover/graphs/contributors
[opensource]: http://www.opensource.org/licenses/MIT
[symfony-console]: http://symfony.com/doc/current/components/console/introduction.html
