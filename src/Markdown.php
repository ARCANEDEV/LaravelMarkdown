<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown;

use Arcanedev\LaravelMarkdown\Contracts\Markdown as MarkdownContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Manager;

/**
 * Class     Markdown
 *
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

    /**
     * Build all the registered parsers.
     */
    public function buildParsers(): void
    {
        foreach ($this->config->get('markdown.parsers', []) as $name => $parser) {
            $this->extend($name, function (Application $app) use ($parser) {
                return $app->make($parser['class']);
            });
        }
    }
}
