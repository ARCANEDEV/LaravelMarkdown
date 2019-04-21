<?php namespace Arcanedev\LaravelMarkdown\Tests\Facades;

use Arcanedev\LaravelMarkdown\Facades\Markdown;
use Arcanedev\LaravelMarkdown\Tests\TestCase;

/**
 * Class     MarkdownTest
 *
 * @package  Arcanedev\LaravelMarkdown\Tests\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarkdownTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_parse_markdown_into_html()
    {
        static::assertEquals(
            '<h1>Hello</h1>',
            Markdown::parse('# Hello')
        );
    }

    /** @test */
    public function it_parse_a_block_of_markdown_into_html()
    {
        Markdown::begin();
        echo "# Hello\n";
        echo 'This text is **bold**!';
        $html = Markdown::end();

        static::assertEquals(
            "<h1>Hello</h1>\n<p>This text is <strong>bold</strong>!</p>",
            $html
        );
    }

    /** @test */
    public function it_can_parse_via_blade_directive()
    {
        /** @var  \Illuminate\Contracts\View\Factory  $view */
        $view = view();

        $expectations = [
            'blade-directive-one' => '<h1>Hello</h1>',
            'blade-directive-two' => "<h1>Hello</h1>\n<p>This text is <strong>bold</strong>!</p>",
        ];

        foreach ($expectations as $name => $expected) {
            static::assertEquals($expected, $view->make($name)->render());
        }
    }

    /** @test */
    public function it_can_clean_javascript_from_links()
    {
        static::assertEquals(
            '<p><a href="#">Link</a></p>',
            Markdown::parse("[Link](javascript:alert('hello'))")
        );

        $this->app['config']->set('markdown.xss', false);

        static::assertEquals(
            '<p><a href="javascript:alert(&#039;hello&#039;)">Link</a></p>',
            Markdown::parse("[Link](javascript:alert('hello'))")
        );
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\LaravelMarkdown\Exceptions\ParserBufferingException
     * @expectedExceptionMessage  Markdown buffering have not been started.
     */
    public function it_must_throw_an_exception_when_the_buffering_is_not_started()
    {
        Markdown::end();
    }
}
