<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown;

use Arcanedev\Support\Providers\PackageServiceProvider;
use Illuminate\Support\Facades\Blade;

/**
 * Class     MarkdownServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarkdownServiceProvider extends PackageServiceProvider
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
        Blade::directive('markdown', function (string $markdown): string {
            return empty($markdown)
                ? '<?php markdown()->begin(); ?>'
                : "<?php echo markdown()->parse({$markdown}); ?>";
        });

        Blade::directive('endmarkdown', fn(): string => '<?php echo markdown()->end(); ?>');
    }
}
