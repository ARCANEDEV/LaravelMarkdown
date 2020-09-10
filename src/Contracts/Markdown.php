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
     *
     * @param  string|null  $driver
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Parser
     */
    public function parser($driver = null);

    /**
     * Build all the registered parsers.
     *
     * @return void
     */
    public function buildParsers();
}
