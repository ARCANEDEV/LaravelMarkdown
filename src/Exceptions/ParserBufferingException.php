<?php

declare(strict_types=1);

namespace Arcanedev\LaravelMarkdown\Exceptions;

use Exception;

/**
 * Class     ParserBufferingException
 *
 * @package  Arcanedev\LaravelMarkdown\Exceptions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ParserBufferingException extends Exception
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public static function notStarted(): self
    {
        return new static('Markdown buffering have not been started.');
    }
}
