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

use function Chevere\Message\message;
use Chevere\Throwable\Errors\TypeError;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use ReflectionFunction;
use ReflectionParameter;

function import(string $relPath, string ...$namedVars): string
{
    $path = (new ImportPath($relPath))->path();
    $realPath = realpath($path);
    if (!$realPath) {
        throw new InvalidArgumentException(
            message('Template %path% not found')
                ->code('%path%', $path)
        );
    }
    $callable = require $realPath;
    if (!is_callable($callable)) {
        throw new TypeError(
            message('Template %path% is not of type callable')
                ->code('%path%', $path)
        );
    }
    $reflection = new ReflectionFunction($callable);
    if (!$reflection->hasReturnType()) {
        throw new TypeError(
            message('Template %path% has no return type')
                ->code('%path%', $path)
        );
    }
    /** @var string $return */
    $return = $reflection->getReturnType()->getName();
    if ($return !== 'string') {
        throw new TypeError(
            message('Template %path% must return string')
                ->code('%path%', $path)
        );
    }
    $parameters = $reflection->getParameters();
    $missingVars = [];
    /** @var ReflectionParameter $parameter */
    foreach ($parameters as $pos => $parameter) {
        if ($parameter->isOptional()) {
            continue;
        }
        if (!array_key_exists($parameter->name, $namedVars)) {
            $missingVars[] = $parameter->name;
        }
    }
    if ($missingVars !== []) {
        throw new InvalidArgumentException(
            message('Missing variables %parameters% for template %path%')
                    ->code('%path%', $path)
                    ->code('%parameters%', implode(', ', $missingVars))
        );
    }

    return $callable(...$namedVars);
}
