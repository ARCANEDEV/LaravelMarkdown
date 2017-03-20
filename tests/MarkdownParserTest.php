<?php namespace Arcanedev\LaravelMarkdown\Tests;

/**
 * Class     MarkdownParserTest
 *
 * @package  Arcanedev\LaravelMarkdown\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarkdownParserTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\LaravelMarkdown\Contracts\Parser */
    protected $parser;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->parser = $this->app->make(\Arcanedev\LaravelMarkdown\Contracts\Parser::class);
    }

    public function tearDown()
    {
        unset($this->parser);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(
            \Arcanedev\LaravelMarkdown\MarkdownParser::class,
            $this->parser
        );
    }

    /** @test */
    public function it_can_parse_markdown_into_html()
    {
        $this->assertEquals(
            '<h1>Hello</h1>',
            $this->parser->parse('# Hello')
        );
    }

    /** @test */
    public function it_parse_a_block_of_markdown_into_html()
    {
        $this->parser->begin();
        echo "# Hello\n";
        echo 'This text is **bold**!';
        $html = $this->parser->end();

        $this->assertEquals(
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
            $this->assertEquals($expected, $view->make($name)->render());
        }
    }


    /** @test */
    public function it_can_clean_xss()
    {
        $this->assertEquals(
            '<p><a href="#">Link</a></p>',
            $this->parser->parse("[Link](javascript:alert('hello'))")
        );

        $this->app['config']->set('markdown.xss', false);

        $this->assertEquals(
            '<p><a href="javascript:alert(\'hello\')">Link</a></p>',
            $this->parser->parse("[Link](javascript:alert('hello'))")
        );
    }

    /** @test */
    public function it_can_escape_markups()
    {
        $this->assertEquals(
            '<p>&lt;b&gt;This is a script&lt;/b&gt;&lt;script&gt;alert(\'hello\');&lt;/script&gt;</p>',
            $this->parser->parse("<b>This is a script</b><script>alert('hello');</script>")
        );

        $this->app['config']->set('markdown.markups', false);

        $this->assertEquals(
            '<p><b>This is a script</b><script>alert(\'hello\');</script></p>',
            $this->parser->parse("<b>This is a script</b><script>alert('hello');</script>")
        );
    }

    /** @test */
    public function it_can_autolink_the_urls()
    {
        $md = 'You can find Parsedown at http://parsedown.org';

        $this->assertEquals(
            '<p>You can find Parsedown at <a href="http://parsedown.org">http://parsedown.org</a></p>',
            $this->parser->parse($md)
        );

        $this->app['config']->set('markdown.urls', false);

        $this->assertEquals(
            '<p>You can find Parsedown at http://parsedown.org</p>',
            $this->parser->parse($md)
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
        $this->parser->end();
    }
}
