<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Parsers;

use Arcanedev\LaravelMarkdown\Contracts\Parser;
use Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException;
use Illuminate\Support\HtmlString;

/**
 * Class     AbstractParser
 *
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
     */
    protected bool $buffering = false;

    /**
     * Parser's options.
     */
    protected array $options = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the parser's options.
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Set the parser's options.
     */
    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert the given Markdown text into HTML.
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
     * @throws \Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException
     * @throws \Throwable
     */
    public function end(): HtmlString
    {
        throw_unless($this->buffering, ParserBufferingException::notStarted());

        $markdown = ob_get_clean();
        $this->buffering = false;

        return $this->parse($markdown);
    }
}
