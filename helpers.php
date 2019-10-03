<?php

use Arcanedev\LaravelMarkdown\Contracts\Parser;

if ( ! function_exists('markdown')) {
    /**
     * Helper function to parse a markdown string to HTML or return the parser instance if the content is null.
     *
     * @param  string|null  $content
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Parser|string
     */
    function markdown($content = null) {
        $markdown = app(Parser::class);

        return is_null($content) ? $markdown : $markdown->parse($content);
    }
}
