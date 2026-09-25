<div align="center">
    <h1>Sialk</h1>
</div>

<p align="center">
    <a href="https://packagist.org/packages/rabsana/sialk"><img src="https://img.shields.io/packagist/v/rabsana/sialk.svg?style=flat-square" alt="Packagist"></a>
    <a href="https://packagist.org/packages/rabsana/sialk"><img src="https://img.shields.io/packagist/php-v/rabsana/sialk.svg?style=flat-square" alt="PHP from Packagist"></a>
    <a href="https://packagist.org/packages/rabsana/sialk"><img src="https://badge.laravel.cloud/badge/rabsana/sialk?style=flat" alt="Laravel versions"></a>
    <a href="https://github.com/rabsana/sialk/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/rabsana/sialk/tests.yml?branch=main&label=Tests&style=flat-square"></a>
    <a href="https://packagist.org/packages/rabsana/sialk"><img src="https://img.shields.io/packagist/dt/rabsana/sialk.svg?style=flat-square" alt="Total Downloads"></a>
</p>

General tools for creating Laravel projects

## Installation

You can install the package via Composer:

```bash
composer require rabsana/sialk
```

You may publish all of the package's resources at once:

```bash
php artisan vendor:publish --tag="sialk"
```

Or, you may publish each resource individually:

### Publishing the Configuration File

```bash
php artisan vendor:publish --tag="sialk-config"
```

### Publishing and Running the Migrations

```bash
php artisan vendor:publish --tag="sialk-migrations"
php artisan migrate
```

### Publishing the Views

```bash
php artisan vendor:publish --tag="sialk-views"
```

### Publishing the Translations

```bash
php artisan vendor:publish --tag="sialk-lang"
```

### Publishing the Public Assets

```bash
php artisan vendor:publish --tag="sialk-assets"
```

## Usage

<!-- Add a basic usage example here. -->

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Thank you for considering contributing to Sialk! Please review our [contributing guide](.github/CONTRIBUTING.md) to get started.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Sajjad Sisakhti](https://github.com/rabsana)
- [All Contributors](../../contributors)

## License

Sialk is open-sourced software licensed under the [MIT license](LICENSE.md).
