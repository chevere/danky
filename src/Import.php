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

use function Chevere\Filesystem\filePhpReturnForPath;
use Chevere\Filesystem\Interfaces\DirInterface;
use Chevere\Filesystem\Interfaces\FilePhpReturnInterface;
use function Chevere\Message\message;
use Chevere\Str\Str;
use Chevere\Throwable\Exceptions\InvalidArgumentException;

final class Import
{
    private FilePhpReturnInterface $file;

    public function __construct(
        private string $path,
        private DirInterface $dir
    ) {
        $this->path = strictPath($path);
        $this->setFile();
    }

    public function path(): string
    {
        return $this->path;
    }

    public function file(): FilePhpReturnInterface
    {
        return $this->file;
    }

    private function setFile(): void
    {
        $path = (new Str($this->path))
            ->withReplaceFirst('./', $this->dir->path()->__toString())
            ->__toString();
        $realPath = realpath($path);
        if (!$realPath) {
            throw new InvalidArgumentException(
                message('Template %path% not found')
                    ->code('%path%', $path)
            );
        }
        $this->file = filePhpReturnForPath($realPath);
    }
}
