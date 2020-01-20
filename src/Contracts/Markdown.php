<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Contracts;

use Illuminate\Support\HtmlString;

/**
 * Interface     Markdown
 *
 * @package  Arcanedev\LaravelMarkdown\Contracts
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
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
}
