<?php namespace Arcanedev\LaravelMarkdown;

use Arcanedev\Support\Providers\PackageServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Blade;

/**
 * Class     LaravelMarkdownServiceProvider
 *
 * @package  Arcanedev\LaravelMarkdown
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LaravelMarkdownServiceProvider extends PackageServiceProvider implements DeferrableProvider
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->registerConfig();

        $this->singleton(Contracts\Parser::class, MarkdownParser::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishConfig();

        $this->extendBladeDirectives();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
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
     * Register Blade directives.
     */
    private function extendBladeDirectives(): void
    {
        Blade::directive('markdown', function ($markdown) {
            return empty($markdown)
                ? '<?php markdown()->begin(); ?>'
                : "<?php echo markdown()->parse($markdown); ?>";
        });

        Blade::directive('endmarkdown', function () {
            return '<?php echo markdown()->end(); ?>';
        });
    }
}
