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
use Chevere\Str\Str;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use Chevere\Throwable\Exceptions\LogicException;

final class ImportPath
{
    private string $path;

    private string $basePath;

    public function __construct(private string $relativePath)
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
        $file = $backtrace['file'] ?? '';
        if ($file === '') {
            throw new LogicException(
                message('Unable to determine caller file.')
            );
        }
        $this->basePath = dirname($file);
        $this->handleRelativePath();
        $this->setPath();
    }

    public function path(): string
    {
        return $this->path;
    }

    public function basePath(): string
    {
        return $this->basePath;
    }

    public function relativePath(): string
    {
        return $this->relativePath;
    }

    private function handleRelativePath(): void
    {
        if (!str_starts_with($this->relativePath, './')) {
            $this->relativePath = './' . $this->relativePath;
        }
        if (!str_ends_with($this->relativePath, '.php')) {
            $this->relativePath .= '.php';
        }
    }

    private function setPath(): void
    {
        $path = (new Str($this->relativePath))
            ->withReplaceFirst('./', $this->basePath . '/')
            ->__toString();
        $realPath = realpath($path);
        if (!$realPath) {
            throw new InvalidArgumentException(
                message('Template %path% not found')
                    ->code('%path%', $path)
            );
        }
        $this->path = $realPath;
    }
}
