<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Providers;

use Arcanedev\LaravelMarkdown\Contracts\Markdown as MarkdownContract;
use Arcanedev\LaravelMarkdown\Contracts\Parser;
use Arcanedev\LaravelMarkdown\Markdown;
use Arcanedev\Support\Providers\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     DeferredServicesProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DeferredServicesProvider extends ServiceProvider implements DeferrableProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->singleton(MarkdownContract::class, Markdown::class);

        $this->app->resolving(MarkdownContract::class, function (MarkdownContract $markdown): void {
            $markdown->buildParsers();
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            MarkdownContract::class,
            Parser::class,
        ];
    }
}
