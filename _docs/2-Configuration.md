# 2. Configuration

```php
<?php

return [

    /* -----------------------------------------------------------------
     |  Parsers
     | -----------------------------------------------------------------
     */

    'default' => 'commonmark',

    'parsers' => [
        'commonmark' => [
            'class' => Arcanedev\LaravelMarkdown\Parsers\CommonMarkParser::class,
        ],
    ],

];
```

The default parser is `commonmark` with `Arcanedev\LaravelMarkdown\Parsers\CommonMarkParser` class (check the `league/commonmark` package for more details).

You can create/extend your own parser if you want.
