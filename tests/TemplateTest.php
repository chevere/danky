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
use Chevere\Throwable\Errors\TypeError;
use Chevere\Throwable\Exceptions\InvalidArgumentException;
use Chevere\Throwable\Exceptions\LogicException;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    private function getTemplate(string $basename): Template
    {
        $aux = '_resources';

        return new Template(__DIR__ . "/$aux/$basename.php");
    }

    public function testConstruct(): void
    {
        $template = $this->getTemplate('tag');
        $string = $template->call(tag: 'a', content: 'text');
        $this->assertSame('<a>text</a>', $string);
        $this->expectException(InvalidArgumentException::class);
        $template->call(foo: 'bar');
    }
    
    public function testNotCallable(): void
    {
        $this->expectException(TypeError::class);
        $this->getTemplate('not-callable');
    }

    public function testUndefinedVars(): void
    {
        $this->expectException(LogicException::class);
        $this->getTemplate('undefined-vars');
    }

    public function testCallableNoReturn(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionCode(100);
        $this->getTemplate('callable-no-return');
    }

    public function testCallableNoStringReturn(): void
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionCode(110);
        $this->getTemplate('callable-no-string-return');
    }
}
