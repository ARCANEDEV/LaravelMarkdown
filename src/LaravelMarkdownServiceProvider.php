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

        $this->singleton(Contracts\Parser::class, function () {
            return new MarkdownParser(new Parsedown);
        });

        $this->singleton('arcanedev.markdown', Contracts\Parser::class);
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
            Contracts\Parser::class,
            'arcanedev.markdown',
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

        $blade->directive('parsedown', function ($markdown) {
            return "<?php echo markdown()->parse($markdown); ?>";
        });

        $blade->directive('markdown', function () {
            return '<?php markdown()->begin(); ?>';
        });

        $blade->directive('endmarkdown', function () {
            return '<?php echo markdown()->end(); ?>';
        });
    }
}
