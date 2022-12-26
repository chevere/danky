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

use Chevere\Tests\_resources\FailingTemplate;
use Chevere\Tests\_resources\SuccessTemplate;
use Chevere\Throwable\Exceptions\LogicException;
use PHPUnit\Framework\TestCase;

final class TemplateTest extends TestCase
{
    public function testMissingRender(): void
    {
        $template = new FailingTemplate();
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            sprintf('Property $render must be assigned before calling %s::__toString', $template::class)
        );
        $template->__toString();
    }

    public function testRenderAssert(): void
    {
        $template = new SuccessTemplate();
        $templateWithRender = $template->withRender();
        $this->assertSame('success', $templateWithRender->__toString());
        $this->assertSame('success', strval($templateWithRender->render()));
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            sprintf('Property $render must be assigned before calling %s::render', $template::class)
        );
        $template->render();
    }
}
