<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Tests;

use Illuminate\Support\HtmlString;

/**
 * Class     MarkdownParserTest
 *
 * @package  Arcanedev\LaravelMarkdown\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarkdownTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $markdown = $this->markdown();

        $expectations = [
            \Illuminate\Support\Manager::class,
            \Arcanedev\LaravelMarkdown\Contracts\Markdown::class,
            \Arcanedev\LaravelMarkdown\Markdown::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $markdown);
        }
    }

    /** @test */
    public function it_can_get_parser(): void
    {
        $parser = $this->markdown()->parser();

        $expectations = [
            \Arcanedev\LaravelMarkdown\Contracts\Parser::class,
            \Arcanedev\LaravelMarkdown\Parsers\AbstractParser::class,
            \Arcanedev\LaravelMarkdown\Parsers\CommonMarkParser::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $parser);
        }
    }

    /** @test */
    public function it_can_parse_markdown_into_html(): void
    {
        $parsed = $this->markdown()->parse('# Hello');

        static::assertInstanceOf(HtmlString::class, $parsed);
        static::assertStringContainsString('<h1>Hello</h1>', $parsed->toHtml());
    }

    /** @test */
    public function it_parse_a_block_of_markdown_into_html(): void
    {
        $md = $this->markdown();

        $md->begin();
        echo "# Hello\n";
        echo 'This text is **bold**!';
        $html = $md->end();

        static::assertStringContainsString(
            "<h1>Hello</h1>\n<p>This text is <strong>bold</strong>!</p>",
            $html->toHtml()
        );
    }

    /** @test */
    public function it_can_parse_via_blade_directive(): void
    {
        /** @var  \Illuminate\Contracts\View\Factory  $view */
        $view = $this->app['view'];

        $expectations = [
            'blade-directive-one' => '<h1>Hello</h1>',
            'blade-directive-two' => "<h1>Hello</h1>\n<p>This text is <strong>bold</strong>!</p>",
        ];

        foreach ($expectations as $name => $expected) {
            static::assertStringContainsString($expected, $view->make($name)->render());
        }
    }

    /** @test */
    public function it_can_clean_xss(): void
    {
        static::assertStringContainsString(
            '<p><a>Link</a></p>',
            $this->markdown()->parse("[Link](javascript:alert('hello'))")->toHtml()
        );

        $this->app['config']->set('markdown.xss', false);

        static::assertStringContainsString(
            '<p><a>Link</a></p>',
            $this->markdown()->parse("[Link](javascript:alert('hello'))")->toHtml()
        );

        $this->app['config']->set('markdown.safe-mode', true);

        static::assertStringContainsString(
            '<p><a>Link</a></p>',
            $this->markdown()->parse("[Link](javascript:alert('hello'))")->toHtml()
        );
    }

    public function it_can_skip_clean_xss(): void
    {
        $this->app['config']->set('markdown.parser.options.allow_unsafe_links', true);

        static::assertStringContainsString(
            '<p><a href="javascript:alert(\'hello\')">Link</a></p>',
            $this->markdown()->parse("[Link](javascript:alert('hello'))")->toHtml()
        );
    }

    /** @test */
    public function it_can_skip_escape_markups(): void
    {
        $this->app['config']->set('markdown.parser.options.html_input', false);

        static::assertStringContainsString(
            '<p><b>This is a script</b><script>alert(\'hello\');</script></p>',
            $this->markdown()->parse("<b>This is a script</b><script>alert('hello');</script>")->toHtml()
        );
    }

    /** @test */
    public function it_must_throw_an_exception_when_the_buffering_is_not_started(): void
    {
        $this->expectException(\Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException::class);
        $this->expectExceptionMessage('Markdown buffering have not been started.');

        $this->markdown()->end();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the markdown instance.
     *
     * @return \Arcanedev\LaravelMarkdown\Contracts\Markdown
     */
    protected function markdown()
    {
        return $this->app->make(\Arcanedev\LaravelMarkdown\Contracts\Markdown::class);
    }
}
