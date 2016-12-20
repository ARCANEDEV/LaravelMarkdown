<?php

if ( ! function_exists('markdown')) {
    /**
     * Helper function to parse a markdown string to HTML or return the parser instance if the content is null.
     *
     * @param  string  $content
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Parser|string
     */
    function markdown($content = null) {
        $markdown = app(Arcanedev\LaravelMarkdown\Contracts\Parser::class);

        return is_null($content) ? $markdown : $markdown->parse($content);
    }
}
