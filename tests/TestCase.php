<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->app->loadDeferredProviders();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\LaravelMarkdown\LaravelMarkdownServiceProvider::class,
            \Arcanedev\LaravelMarkdown\Providers\DeferredServicesProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        /** @var  \Illuminate\Config\Repository  $config */
        $config = $app['config'];

        $config->set('view.paths', [
            realpath(__DIR__ . '/fixtures/views')
        ]);
    }
}
