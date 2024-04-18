# [README en Français](README.MD)

# This is my package newyoutube

[![Latest Version on Packagist](https://img.shields.io/packagist/v/leknoppix/newyoutube.svg?style=flat-square)](https://packagist.org/packages/leknoppix/newyoutube)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/leknoppix/newyoutube/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/leknoppix/newyoutube/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/leknoppix/newyoutube/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/leknoppix/newyoutube/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/leknoppix/newyoutube.svg?style=flat-square)](https://packagist.org/packages/leknoppix/newyoutube)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require leknoppix/newyoutube
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="newyoutube-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="newyoutube-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="newyoutube-views"
```

## Usage

```php
$newYoutube = new Leknoppix\NewYoutube();
echo $newYoutube->echoPhrase('Hello, Leknoppix!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Pascal Canadas](https://github.com/leknoppix)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
