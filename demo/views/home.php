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

use function Chevere\Danky\import;

return function (string $header, string $footer): string {
    $title = 'Home';
    $head = <<<EOT
        <link rel="stylesheet" href="/web/css/home.css">
    EOT;
    $body = <<<EOT
    $header
        <main>$title</main>
    $footer
    EOT;

    return import(
        'container/html',
        head: $head,
        body: $body,
    );
};
