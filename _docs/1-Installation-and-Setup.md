# 1. Installation

## Version Compatibility

| Laravel                      | Laravel Markdown                                                                              |
|:-----------------------------|:----------------------------------------------------------------------------------------------|
| ![Laravel v9.x][laravel_9_x] | ![Laravel Markdown v6.x][laravel_markdown_6_x]                                                |
| ![Laravel v8.x][laravel_8_x] | ![Laravel Markdown v5.x][laravel_markdown_5_x]                                                |
| ![Laravel v7.x][laravel_7_x] | ![Laravel Markdown v4.x][laravel_markdown_4_x]                                                |
| ![Laravel v6.x][laravel_6_x] | ![Laravel Markdown v2.x][laravel_markdown_2_x] ![Laravel Markdown v3.x][laravel_markdown_3_x] |
| ![Laravel v5.8][laravel_5_8] | ![Laravel Markdown v1.6.x][laravel_markdown_1_6_x]                                            |
| ![Laravel v5.7][laravel_5_7] | ![Laravel Markdown v1.5.x][laravel_markdown_1_5_x]                                            |
| ![Laravel v5.6][laravel_5_6] | ![Laravel Markdown v1.4.x][laravel_markdown_1_4_x]                                            |
| ![Laravel v5.5][laravel_5_5] | ![Laravel Markdown v1.3.x][laravel_markdown_1_3_x]                                            |
| ![Laravel v5.4][laravel_5_4] | ![Laravel Markdown v1.2.x][laravel_markdown_1_2_x]                                            |
| ![Laravel v5.3][laravel_5_3] | ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x]                                            |
| ![Laravel v5.2][laravel_5_2] | ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x]                                            |
| ![Laravel v5.1][laravel_5_1] | ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x]                                            |
| ![Laravel v5.0][laravel_5_0] | ![Laravel Markdown v1.1.x][laravel_markdown_1_1_x]                                            |

[laravel_9_x]:  https://img.shields.io/badge/version-9.x-blue.svg?style=flat-square "Laravel v9.x"
[laravel_8_x]:  https://img.shields.io/badge/version-8.x-blue.svg?style=flat-square "Laravel v8.x"
[laravel_7_x]:  https://img.shields.io/badge/version-7.x-blue.svg?style=flat-square "Laravel v7.x"
[laravel_6_x]:  https://img.shields.io/badge/version-6.x-blue.svg?style=flat-square "Laravel v6.x"
[laravel_5_8]:  https://img.shields.io/badge/version-5.8-blue.svg?style=flat-square "Laravel v5.8"
[laravel_5_7]:  https://img.shields.io/badge/version-5.7-blue.svg?style=flat-square "Laravel v5.7"
[laravel_5_6]:  https://img.shields.io/badge/version-5.6-blue.svg?style=flat-square "Laravel v5.6"
[laravel_5_5]:  https://img.shields.io/badge/version-5.5-blue.svg?style=flat-square "Laravel v5.5"
[laravel_5_4]:  https://img.shields.io/badge/version-5.4-blue.svg?style=flat-square "Laravel v5.4"
[laravel_5_3]:  https://img.shields.io/badge/version-5.3-blue.svg?style=flat-square "Laravel v5.3"
[laravel_5_2]:  https://img.shields.io/badge/version-5.2-blue.svg?style=flat-square "Laravel v5.2"
[laravel_5_1]:  https://img.shields.io/badge/version-5.1-blue.svg?style=flat-square "Laravel v5.1"
[laravel_5_0]:  https://img.shields.io/badge/version-5.0-blue.svg?style=flat-square "Laravel v5.0"

[laravel_markdown_6_x]:   https://img.shields.io/badge/version-6.x-blue.svg?style=flat-square "Laravel Markdown v6.x"
[laravel_markdown_5_x]:   https://img.shields.io/badge/version-5.x-blue.svg?style=flat-square "Laravel Markdown v5.x"
[laravel_markdown_4_x]:   https://img.shields.io/badge/version-4.x-blue.svg?style=flat-square "Laravel Markdown v4.x"
[laravel_markdown_3_x]:   https://img.shields.io/badge/version-3.x-blue.svg?style=flat-square "Laravel Markdown v3.x"
[laravel_markdown_2_x]:   https://img.shields.io/badge/version-2.x-blue.svg?style=flat-square "Laravel Markdown v2.x"
[laravel_markdown_1_6_x]: https://img.shields.io/badge/version-1.6.x-blue.svg?style=flat-square "Laravel Markdown v1.6.x"
[laravel_markdown_1_5_x]: https://img.shields.io/badge/version-1.5.x-blue.svg?style=flat-square "Laravel Markdown v1.5.x"
[laravel_markdown_1_4_x]: https://img.shields.io/badge/version-1.4.x-blue.svg?style=flat-square "Laravel Markdown v1.4.x"
[laravel_markdown_1_3_x]: https://img.shields.io/badge/version-1.3.x-blue.svg?style=flat-square "Laravel Markdown v1.3.x"
[laravel_markdown_1_2_x]: https://img.shields.io/badge/version-1.2.x-blue.svg?style=flat-square "Laravel Markdown v1.2.x"
[laravel_markdown_1_1_x]: https://img.shields.io/badge/version-1.1.x-blue.svg?style=flat-square "Laravel Markdown v1.1.x"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/laravel-markdown`.

## Laravel Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
'providers' => [
    ...
    Arcanedev\LaravelMarkdown\MarkdownServiceProvider::class,
],
```

### Artisan command

To publish the config file, run this command:

```bash
$ php artisan vendor:publish --provider="Arcanedev\LaravelMarkdown\MarkdownServiceProvider"
```
