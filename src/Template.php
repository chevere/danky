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
use Chevere\Throwable\Exceptions\LogicException;
use ReflectionFunction;
use Throwable;

final class Template
{
    private mixed $callable;
    
    private ReflectionFunction $reflection;

    public function __construct(private string $path)
    {
        try {
            $this->callable = require $this->path;
        } catch (Throwable $e) {
            throw new LogicException(
                message: message('Unable to require %path% [%message%]')
                    ->code('%path%', $this->path)
                    ->code('%message%', $e->getMessage()),
                previous: $e->getPrevious()
            );
        }
        $this->assertCallable();
        $this->reflection = new ReflectionFunction($this->callable);
        $this->assertReturnType();
    }

    public function call(string ...$namedVars): string
    {
        $this->assertCallParameters(...$namedVars);
        
        /** @var callable $function */
        $function = $this->callable;

        return $function(...$namedVars);
    }

    private function assertCallable(): void
    {
        if (!is_callable($this->callable)) {
            throw new TypeError(
                message('Template %path% is not of type callable')
                    ->code('%path%', $this->path)
            );
        }
    }

    private function assertReturnType(): void
    {
        if (!$this->reflection->hasReturnType()) {
            throw new TypeError(
                message: message('Template %path% has no return type')
                    ->code('%path%', $this->path),
                code: 100
            );
        }
        /** @var string $return */
        $return = $this->reflection->getReturnType()->getName();
        if ($return !== 'string') {
            throw new TypeError(
                message: message('Template %path% must return string')
                    ->code('%path%', $this->path),
                code: 110
            );
        }
    }

    private function assertCallParameters(string ...$namedVars): void
    {
        $missingVars = [];
        /** @var ReflectionParameter $parameter */
        foreach ($this->reflection->getParameters() as $parameter) {
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
                        ->code('%path%', $this->path)
                        ->code('%parameters%', implode(', ', $missingVars))
            );
        }
    }
}
