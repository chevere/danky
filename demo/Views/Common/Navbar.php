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

namespace Chevere\Danky\Demo\Views\Common;

use Chevere\Danky\Template;

class Navbar extends Template
{
    public function __construct()
    {
        $this->render = <<<HTML
            <nav>Nav</nav>
        HTML;
    }
}
