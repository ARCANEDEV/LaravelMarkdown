<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown;

use Arcanedev\LaravelMarkdown\Contracts\Markdown as MarkdownContract;
use Illuminate\Support\Manager;

/**
 * Class     Markdown
 *
 * @package  Arcanedev\LaravelMarkdown
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @method  \Illuminate\Support\HtmlString  parse(string $text)
 * @method  void                            begin()
 * @method  \Illuminate\Support\HtmlString  end()
 *
 * @mixin  \Arcanedev\LaravelMarkdown\Parsers\AbstractParser
 */
class Markdown extends Manager implements MarkdownContract
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('markdown.default');
    }

    /**
     * Get the parser instance.
     *
     * @param  string|null  $driver
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Parser
     */
    public function parser($driver = null)
    {
        return $this->driver($driver);
    }
}
