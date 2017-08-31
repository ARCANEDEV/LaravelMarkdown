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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerConfig();

        $this->registerMarkdownParser();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

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
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the Markdown parser.
     */
    private function registerMarkdownParser()
    {
        $this->singleton(Contracts\Parser::class, function () {
            return new MarkdownParser(new Parsedown);
        });
    }

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
