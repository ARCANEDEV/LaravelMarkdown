<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Contracts;

/**
 * Interface  Markdown
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Markdown
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the parser instance.
     */
    public function parser(?string $driver = null): Parser;

    /**
     * Build all the registered parsers.
     */
    public function buildParsers(): void;
}
