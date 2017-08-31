<?php namespace Arcanedev\LaravelMarkdown;

use Arcanedev\LaravelMarkdown\Contracts\Parser;
use Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException;
use Parsedown;

/**
 * Class     MarkdownParser
 *
 * @package  Arcanedev\LaravelMarkdown\Parsers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarkdownParser implements Parser
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Markdown parser.
     *
     * @var \Parsedown
     */
    protected $parser;

    /**
     * Indicates if the parser is currently buffering input.
     *
     * @var bool
     */
    protected $buffering = false;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * MarkdownParser constructor.
     *
     * @param  \Parsedown  $parser
     */
    public function __construct(Parsedown $parser)
    {
        $this->parser = $parser;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Parses a markdown string to HTML.
     *
     * @param  string  $content
     *
     * @return string
     */
    public function parse($content)
    {
        $this->parser->setUrlsLinked(config('markdown.urls', true));
        $this->parser->setMarkupEscaped(config('markdown.markups', true));

        if (config('markdown.xss', true)) {
            $content = preg_replace('/(\[.*\])\(javascript:.*\)/', '$1(#)', $content);
        }

        return $this->parser->text($content);
    }

    /**
     * Start buffering output to be parsed.
     */
    public function begin()
    {
        $this->buffering = true;
        ob_start();
    }

    /**
     * Stop buffering output & return the parsed markdown string.
     *
     * @return string
     *
     * @throws \Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException
     */
    public function end()
    {
        if ($this->buffering === false) {
            throw new ParserBufferingException('Markdown buffering have not been started.');
        }

        $markdown        = ob_get_clean();
        $this->buffering = false;

        return $this->parse($markdown);
    }
}
