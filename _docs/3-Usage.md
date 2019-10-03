# 3. Usage

## Table of contents

  * [Blade](#blade)
  * [Helper](#helper)
  * [Service Container](#service-container)

### Blade

The Markdown parser can be used in your Blade files with the `@markdown` directive:

```html
<article>
    <h1 class="page-header">{{ $post->title }}</h1>

    <section class="content">
        @markdown($post->content)
    </section>
</article>
```

You can also use the `@markdown` blade directive as the `@section` blocks syntax:

```markdown
@markdown
# My awesome header

This text is *italic* but this one is **bold**, you can also add a [Link](http://www.example.com).
@endmarkdown
```

### Helper

The markdown helper offers an easiest way to parse your content, you can use it anywhere in your project:

```php
echo markdown('# Hello'); // <h1>Hello</h1>
```

##### OR

```php
echo markdown()->parse('# Hello') // <h1>Hello</h1>
```

As you can see, the `markdown()` helper can return a `Arcanedev\LaravelMarkdown\MarkdownParser` object when there is no arguments.

### Service Container

Of course, you could also resolve the parser from the service container.

```php
$parser = app('Arcanedev\LaravelMarkdown\Contracts\Parser');

echo $parser->parse('# Hello'); // <h1>Hello</h1>
```

You can also inject the dependency into the class via the constructor for example:

```php
<?php

namespace App\Http\Controllers;

use Arcanedev\LaravelMarkdown\Contracts\Parser as MarkdownParser;

class PagesController implements Controller
{
    /**
     * The markdown parser.
     *
     * @var  \Arcanedev\LaravelMarkdown\Contracts\Parser
     */
    protected $parser;

    /**
     * Create a new instance.
     *
     * @param  \Arcanedev\LaravelMarkdown\Contracts\Parser  $parser
     */
    public function __construct(MarkdownParser $parser)
    {
        $this->parser = $parser;
    }

    //...
}
```
