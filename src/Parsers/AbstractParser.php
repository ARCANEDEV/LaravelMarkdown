<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Parsers;

use Arcanedev\LaravelMarkdown\Contracts\Parser;
use Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException;
use Illuminate\Support\HtmlString;

/**
 * Class     AbstractParser
 *
 * @package  Arcanedev\LaravelMarkdown\Parsers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractParser implements Parser
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if the parser is currently buffering input.
     *
     * @var bool
     */
    protected $buffering = false;

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
    abstract public function parse(string $text): HtmlString;

    /**
     * Start buffering output to be parsed.
     */
    public function begin(): void
    {
        $this->buffering = true;
        ob_start();
    }

    /**
     * Stop buffering output & return the parsed markdown string.
     *
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException
     */
    public function end(): HtmlString
    {
        if ($this->buffering === false) {
            throw new ParserBufferingException('Markdown buffering have not been started.');
        }

        $markdown        = ob_get_clean();
        $this->buffering = false;

        return $this->parse($markdown);
    }
}
