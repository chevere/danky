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

use Chevere\Danky\ImportPath;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ImportPathTest extends TestCase
{
    public function testPaths(): void
    {
        foreach (['./tag.php', './tag', 'tag.php'] as $argument) {
            $aux = '_resources';
            $argument = str_replace('%r', $aux, $argument);
            $import = new ImportPath($argument, __DIR__ . "/$aux");
            $this->assertSame($import->basePath(), dirname($import->path()));
            $this->assertSame($import->basePath() . '/tag.php', $import->path());
            $this->assertSame('./tag.php', $import->relativePath());
        }
    }

    public function testMissingPath(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ImportPath('tag.php');
    }
}
