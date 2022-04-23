<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\Danky;

use function Chevere\Filesystem\dirForPath;
use Chevere\Filesystem\Interfaces\DirInterface;
use function Chevere\Message\message;
use Chevere\Throwable\Exceptions\LogicException;

function import(string $path, mixed ...$namedVars): string
{
    $importPath = new Import(
        path: $path,
        dir: callerDir()
    );

    return (new Template($importPath->file()))
        ->call(...$namedVars);
}

function template(string $path): callable
{
    $importPath = new Import(
        path: $path,
        dir: callerDir()
    );

    return (new Template($importPath->file()))
        ->closure();
}

function callerDir(int $depth = 1): DirInterface
{
    $backtrace = debug_backtrace(
        DEBUG_BACKTRACE_IGNORE_ARGS,
        $depth + 1
    )[$depth];
    $file = $backtrace['file'] ?? '';
    if ($file === '') {
        // @codeCoverageIgnoreStart
        throw new LogicException(
            message('Unable to determine caller.')
        );
        // @codeCoverageIgnoreEnd
    }

    return dirForPath(dirname($file));
}
