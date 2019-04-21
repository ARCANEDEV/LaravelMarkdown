# 1. Installation

## Version Compatibility

| Laravel Markdown                                   | Laravel                                                                                                             |
|:---------------------------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x] | ![Laravel v5.0][laravel_5_0] ![Laravel v5.1][laravel_5_1] ![Laravel v5.2][laravel_5_2] ![Laravel v5.3][laravel_5_3] |
| ![Laravel Markdown v1.2.x][laravel_markdown_1_2_x] | ![Laravel v5.4][laravel_5_4]                                                                                        |
| ![Laravel Markdown v1.3.x][laravel_markdown_1_3_x] | ![Laravel v5.5][laravel_5_5]                                                                                        |
| ![Laravel Markdown v1.4.x][laravel_markdown_1_4_x] | ![Laravel v5.6][laravel_5_6]                                                                                        |

[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"
[laravel_5_5]:  https://img.shields.io/badge/v5.5-supported-brightgreen.svg?style=flat-square "Laravel v5.5"
[laravel_5_6]:  https://img.shields.io/badge/v5.6-supported-brightgreen.svg?style=flat-square "Laravel v5.6"

[laravel_markdown_1_1_x]: https://img.shields.io/badge/version-1.1.*-blue.svg?style=flat-square "Laravel Markdown v1.1.*"
[laravel_markdown_1_2_x]: https://img.shields.io/badge/version-1.2.*-blue.svg?style=flat-square "Laravel Markdown v1.2.*"
[laravel_markdown_1_3_x]: https://img.shields.io/badge/version-1.3.*-blue.svg?style=flat-square "Laravel Markdown v1.3.*"
[laravel_markdown_1_4_x]: https://img.shields.io/badge/version-1.4.*-blue.svg?style=flat-square "Laravel Markdown v1.4.*"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/laravel-markdown`.

## Laravel Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
'providers' => [
    ...
    Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider::class,
],
```

### Artisan command

To publish the config file, run this command:

```bash
$ php artisan vendor:publish --provider="Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider"
```
