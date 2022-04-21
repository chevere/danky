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

use Chevere\Danky\Template;
use function Chevere\Filesystem\filePhpReturnForPath;
use Chevere\Throwable\Errors\TypeError;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use Chevere\Throwable\Exceptions\RuntimeException;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    private function getTemplate(string $basename): Template
    {
        $aux = '_resources';

        return new Template(
            filePhpReturnForPath(__DIR__ . "/$aux/$basename.php")
        );
    }

    public function testConstruct(): void
    {
        $args = [
            'tag' => 'a',
            'content' => 'text'
        ];
        $template = $this->getTemplate('tag');
        $string = $template->call(...$args);
        $closure = $template->closure();
        $this->assertSame('<a>text</a>', $closure(...$args));
        $this->assertSame('<a>text</a>', $string);
        $this->expectException(InvalidArgumentException::class);
        $template->call(foo: 'bar');
    }
    
    public function testNotClosure(): void
    {
        $this->expectException(TypeError::class);
        $this->getTemplate('not-closure');
    }

    public function testUndefinedVars(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getTemplate('undefined-vars');
    }

    public function testClosureNoReturn(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionCode(100);
        $this->getTemplate('closure-no-return');
    }

    public function testClosureNoStringReturn(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionCode(110);
        $this->getTemplate('closure-no-string-return');
    }

    public function testClosureUnionReturn(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionCode(120);
        $this->getTemplate('closure-union-return');
    }

    public function testTagOptional(): void
    {
        $template = $this->getTemplate('tag-optional');
        $string = $template->call(tag: 'tag');
        $this->assertSame('<tag>default</tag>', $string);
    }
}
