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

use function Chevere\Danky\import;
use function Chevere\Danky\template;
use PHPUnit\Framework\TestCase;

final class FunctionsTest extends TestCase
{
    public function testImport(): void
    {
        $tag = import(
            './_resources/tag.php',
            tag: 'div',
            content: 'Hello World'
        );
        $this->assertSame(
            '<div>Hello World</div>',
            $tag
        );
    }

    public function testTemplate(): void
    {
        $closure = template(
            './_resources/tag.php',
        );
        $this->assertSame(
            '<div>Hello World</div>',
            $closure(
                ...[
                    'tag' => 'div',
                    'content' => 'Hello World'
                ]
            )
        );
    }
}
