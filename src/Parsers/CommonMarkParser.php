<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Parsers;

use Illuminate\Support\HtmlString;
use League\CommonMark\GithubFlavoredMarkdownConverter;

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
     */
    public function parse(string $text): HtmlString
    {
        $converter = new GithubFlavoredMarkdownConverter($this->getOptions());

        return new HtmlString(
            (string) $converter->convertToHtml($text)
        );
    }
}
