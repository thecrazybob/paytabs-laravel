# PayTabs Gateway for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thecrazybob/paytabs-laravel.svg?style=flat-square)](https://packagist.org/packages/thecrazybob/paytabs-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/thecrazybob/paytabs-laravel/run-tests?label=tests)](https://github.com/thecrazybob/paytabs-laravel/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/thecrazybob/paytabs-laravel.svg?style=flat-square)](https://packagist.org/packages/thecrazybob/paytabs-laravel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require thecrazybob/package-paytabs-laravel-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Thecrazybob\PaytabsLaravel\PaytabsServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Thecrazybob\PaytabsLaravel\PaytabsServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$paytabs-laravel = new Thecrazybob\PaytabsLaravel();
echo $paytabs-laravel->echoPhrase('Hello, Thecrazybob!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@thecrazybob.be instead of using the issue tracker.

## Credits

- [Mohammed Sohail](https://github.com/thecrazybob)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
