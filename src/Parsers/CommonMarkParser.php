<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Parsers;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;

/**
 * Class     CommonMarkParser
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommonMarkParser extends AbstractParser
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
    public function parse(string $text): HtmlString
    {
        $environment = Environment::createCommonMarkEnvironment()
            ->addExtension(new TableExtension);

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ], $environment);

        return new HtmlString($converter->convertToHtml($text));
    }
}
