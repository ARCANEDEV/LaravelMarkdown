<?php namespace Arcanedev\LaravelMarkdown;

use Arcanedev\Support\PackageServiceProvider;
use Parsedown;

/**
 * Class     LaravelMarkdownServiceProvider
 *
 * @package  Arcanedev\LaravelMarkdown
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LaravelMarkdownServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor  = 'arcanedev';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'markdown';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer   = true;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->app->singleton('arcanedev.markdown', function () {
            return new MarkdownParser(new Parsedown);
        });

        $this->bind(
            \Arcanedev\LaravelMarkdown\Contracts\Parser::class,
            'arcanedev.markdown'
        );
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishConfig();
        $this->registerBladeDirectives();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.markdown',
            \Arcanedev\LaravelMarkdown\Contracts\Parser::class,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register Blade directives.
     */
    private function registerBladeDirectives()
    {
        /** @var  \Illuminate\View\Compilers\BladeCompiler  $blade */
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('markdown', function ($markdown) {
            return is_null($markdown)
                ? '<?php markdown()->begin() ?>'
                : "<?php echo markdown()->parse($markdown); ?>";
        });

        $blade->directive('endmarkdown', function () {
            return '<?php echo markdown()->end() ?>';
        });
    }
}
