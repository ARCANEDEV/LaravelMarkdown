<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Contracts;

use Illuminate\Support\HtmlString;

/**
 * Interface  Parser
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Parser
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert the given Markdown text into HTML.
     *
     * @param  string  $text
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function parse(string $text): HtmlString;
}
