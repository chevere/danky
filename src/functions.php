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

use Chevere\Str\Str;

function import(string $relPath, string ...$namedVars): string
{
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 0)[0];
    $file = $backtrace['file'];
    $basePath = dirname($file);
    if (!str_starts_with($relPath, './')) {
        $relPath = './' . $relPath;
    }
    if (!str_ends_with($relPath, '.php')) {
        $relPath .= '.php';
    }
    $absPath = (new Str($relPath))
            ->withReplaceFirst('./', $basePath . '/');
    $realPath = $absPath->__toString();
    $callable = require realpath($realPath);
    if (!is_callable($callable)) {
        return $callable;
    }

    return $callable(...$namedVars);
}
