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

namespace Chevere\Tests\_resources;

use Chevere\Danky\Template;

class SuccessTemplate extends Template
{
    public function __construct()
    {
    }

    public function withRender(): self
    {
        $new = clone $this;
        $new->render = 'success';

        return $new;
    }

    public function render(): string | Template
    {
        $this->assertRender();

        return $this->render;
    }
}
