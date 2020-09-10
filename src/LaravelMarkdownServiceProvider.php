<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown;

use Arcanedev\Support\Providers\PackageServiceProvider;
use Illuminate\Support\Facades\Blade;

/**
 * Class     LaravelMarkdownServiceProvider
 *
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
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishConfig();

        $this->extendBladeDirectives();
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
        Blade::directive('markdown', function (string $markdown) {
            return empty($markdown)
                ? '<?php markdown()->begin(); ?>'
                : "<?php echo markdown()->parse({$markdown}); ?>";
        });

        Blade::directive('endmarkdown', function () {
            return '<?php echo markdown()->end(); ?>';
        });
    }
}
