# 2. Installation

## Server Requirements

The Laravel Markdown package has a few system requirements:

    - PHP >= 5.6.4

## Version Compatibility

| Laravel Markdown                                   | Laravel                                                                                                             |
|:---------------------------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x] | ![Laravel v5.0][laravel_5_0] ![Laravel v5.1][laravel_5_1] ![Laravel v5.2][laravel_5_2] ![Laravel v5.3][laravel_5_3] |
| ![Laravel Markdown v1.2.x][laravel_markdown_1_2_x] | ![Laravel v5.4][laravel_5_4]                                                                                        |

[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"

[laravel_markdown_1_1_x]: https://img.shields.io/badge/version-1.1.*-blue.svg?style=flat-square "Laravel Markdown v1.1.*"
[laravel_markdown_1_2_x]: https://img.shields.io/badge/version-1.2.*-blue.svg?style=flat-square "Laravel Markdown v1.2.*"


## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/laravel-markdown`.

## Laravel Setup

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
'providers' => [
    ...
    Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider::class,
],
```

**Optional :** Alias the Markdown facade by adding it to the aliases array in the `config/app.php` file.

```php
'aliases' => [
    // ...
    'Markdown' => Arcanedev\LaravelMarkdown\Facades\Markdown::class,
],
```

### Artisan command

To publish the config file, run this command:

```bash
$ php artisan vendor:publish --provider="Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider"
```
