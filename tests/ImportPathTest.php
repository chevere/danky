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
use PHPUnit\Framework\TestCase;

final class ImportPathTest extends TestCase
{
    public function testRelativePaths(): void
    {
        foreach (['./file.php', './file', 'file.php'] as $argument) {
            $path = new ImportPath($argument);
            $this->assertSame($path->basePath(), dirname($path->path()));
            $this->assertSame($path->basePath() . '/file.php', $path->path());
            $this->assertSame('./file.php', $path->relativePath());
        }
    }
}
