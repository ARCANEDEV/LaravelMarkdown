# 2. Installation

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/laravel-markdown`.

Or by adding the package to your `composer.json`.

```json
{
    "require": {
        "arcanedev/laravel-markdown": "~1.0"
    }
}
```

Then install it via `composer install` or `composer update`.

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
