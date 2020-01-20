<?php

use Arcanedev\LaravelMarkdown\Contracts\Markdown;

if ( ! function_exists('markdown')) {
    /**
     * Helper function to parse a markdown string to HTML or return the parser instance if the content is null.
     *
     * @param  string|null  $content
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Markdown|string
     */
    function markdown(?string $content = null) {
        /** @var \Arcanedev\LaravelMarkdown\Markdown $markdown */
        $markdown = app(Markdown::class);

        return is_null($content) ? $markdown : $markdown->parse($content);
    }
}
