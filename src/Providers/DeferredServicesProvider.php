<?php namespace Arcanedev\LaravelMarkdown\Providers;

use Arcanedev\LaravelMarkdown\Contracts\Parser as ParserContract;
use Arcanedev\LaravelMarkdown\MarkdownParser;
use Arcanedev\Support\Providers\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class     DeferredServicesProvider
 *
 * @package  Arcanedev\LaravelMarkdown\Providers
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
        $this->singleton(ParserContract::class, MarkdownParser::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            ParserContract::class,
        ];
    }
}
