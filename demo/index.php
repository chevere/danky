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

use Chevere\Danky\Demo\Views\Common\Footer;
use Chevere\Danky\Demo\Views\Common\Header;
use Chevere\Danky\Demo\Views\Home;

require_once __DIR__ . '/../vendor/autoload.php';

echo
    new Home(
        header: new Header(),
        footer: new Footer(),
    );
