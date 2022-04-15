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

namespace Chevere\Tests;

use Chevere\Danky\Import;
use function Chevere\Filesystem\dirForPath;
use Chevere\Filesystem\Interfaces\FilePhpReturnInterface;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ImportTest extends TestCase
{
    public function testPaths(): void
    {
        foreach (['./tag.php', './tag', 'tag.php'] as $path) {
            $aux = '_resources';
            $path = str_replace('%r', $aux, $path);
            $importPath = new Import(
                path: $path,
                dir: dirForPath(__DIR__ . "/$aux")
            );
            $this->assertSame('./tag.php', $importPath->path());
            $this->assertInstanceOf(
                FilePhpReturnInterface::class,
                $importPath->file()
            );
        }
    }

    public function testAbsolutePath(): void
    {
        $path = __DIR__ . '/_resources/tag.php';
        $import = new Import(
            path: $path,
            dir: dirForPath(__DIR__)
        );
        $this->assertSame($path, $import->path());
    }

    public function testMissingPath(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Import('tag.php', dirForPath(__DIR__));
    }
}
