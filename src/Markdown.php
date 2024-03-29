<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown;

use Arcanedev\LaravelMarkdown\Contracts\Markdown as MarkdownContract;
use Arcanedev\LaravelMarkdown\Contracts\Parser;
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
     */
    public function getDefaultDriver(): string
    {
        return $this->config->get('markdown.default');
    }

    /**
     * Get the parser instance.
     */
    public function parser(?string $driver = null): Parser
    {
        return $this->driver($driver);
    }

    /**
     * Build all the registered parsers.
     */
    public function buildParsers(): void
    {
        $parsers = array_keys($this->config->get('markdown.parsers', []));

        foreach ($parsers as $name) {
            $this->extend($name, function (Application $app) use ($name) {
                $config = $app['config'];

                return $app
                    ->make($config->get("markdown.parsers.{$name}.class"))
                    ->setOptions($config->get("markdown.parsers.{$name}.options") ?? []);
            });
        }
    }
}
