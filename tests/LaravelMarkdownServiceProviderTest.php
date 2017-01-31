<?php namespace Arcanedev\LaravelMarkdown\Tests;

use Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider;

/**
 * Class     LaravelMarkdownServiceProviderTest
 *
 * @package  Arcanedev\LaravelMarkdown\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LaravelMarkdownServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider  */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(LaravelMarkdownServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \Arcanedev\LaravelMarkdown\Contracts\Parser::class,
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}
