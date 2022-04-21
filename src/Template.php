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

use Chevere\Filesystem\Interfaces\FilePhpReturnInterface;
use function Chevere\Message\message;
use Chevere\Throwable\Errors\TypeError;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use Closure;
use ReflectionFunction;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

final class Template
{
    private string $path;

    private Closure $closure;
    
    private ReflectionFunction $reflection;

    public function __construct(private FilePhpReturnInterface $file)
    {
        $this->path = $this->file->filePhp()->file()->path()->__toString();

        try {
            // @phpstan-ignore-next-line
            $this->closure = $this->file->raw();
            // @phpstan-ignore-next-line
        } catch (\TypeError $e) {
            throw new TypeError(
                message: message('Template %path% is not a closure [%message%]')
                    ->code('%path%', $this->path)
                    ->strtr('%message%', $e->getMessage()),
                previous: $e
            );
        }
        // @phpstan-ignore-next-line
        $this->reflection = new ReflectionFunction($this->closure);
        $this->assertReturnType();
    }

    public function call(mixed ...$namedVars): string
    {
        $this->assertCallParameters(...$namedVars);
        
        /** @var callable $function */
        $function = $this->closure;

        return $function(...$namedVars);
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
        /** @var ReflectionNamedType|ReflectionUnionType $returnType */
        $returnType = $this->reflection->getReturnType();
        if ($returnType instanceof ReflectionUnionType) {
            throw new TypeError(
                message: message('Template %path% must declare a single %type% return type')
                    ->code('%path%', $this->path)
                    ->code('%type%', 'string'),
                code: 120
            );
        }
        /** @var string $return */
        $return = $returnType->getName();
        if ($return !== 'string') {
            throw new TypeError(
                message: message('Template %path% must declare %type% return type')
                    ->code('%path%', $this->path)
                    ->code('%type%', 'string'),
                code: 110
            );
        }
    }

    private function assertCallParameters(mixed ...$namedVars): void
    {
        $missingVars = [];
        /** @var ReflectionParameter $parameter */
        foreach ($this->reflection->getParameters() as $parameter) {
            if (!$parameter->isOptional()
                && !array_key_exists($parameter->name, $namedVars)) {
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
