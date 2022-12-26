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
use Chevere\Throwable\Exceptions\LogicException;
use Stringable;

abstract class Template implements Stringable
{
    protected string | Template $render;

    final public function __toString(): string
    {
        $this->assertRender();

        return strval($this->render);
    }

    protected function assertRender(): void
    {
        // @codeCoverageIgnoreStart
        $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        // @codeCoverageIgnoreEnd
        $class = static::class;
        if (! isset($this->render)) {
            throw new LogicException(
                message('Property %property% must be assigned before calling %method%')
                    ->withCode('%property%', '$render')
                    ->withCode('%method%', "{$class}::{$method}")
            );
        }
    }
}
