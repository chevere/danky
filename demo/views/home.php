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
use function Chevere\Danky\template;

return function (string $header, string $footer): string {
    $title = 'Home';
    $template = template('common/head');
    $head = <<<HTML
        <link rel="stylesheet" href="/web/css/home.css">
    HTML;
    $body = <<<HTML
    $header
        <main>$title</main>
    $footer
    HTML;

    return import(
        'common/html',
        head: $head,
        body: $body,
    );
};
