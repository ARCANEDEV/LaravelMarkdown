<?php namespace Arcanedev\LaravelMarkdown\Contracts;

/**
 * Interface  Parser
 *
 * @package   Arcanedev\LaravelMarkdown\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Parser
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Parses a markdown string to HTML.
     *
     * @param  string $content
     *
     * @return string
     */
    public function parse($content);

    /**
     * Start capturing output to be parsed.
     *
     * @return void
     */
    public function begin();

    /**
     * Stop capturing output, parse the string from markdown to HTML and return it.
     *
     * @return string
     */
    public function end();
}
