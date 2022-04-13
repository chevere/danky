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

$headerTag = import('common/header');
$footerTag = import('common/footer');
$title = 'Home';
$head = <<<EOT
    <link rel="stylesheet" href="/web/css/home.css">
EOT;
$body = <<<EOT
$headerTag
    <main>$title</main>
$footerTag
EOT;

return
    import(
        'container/html',
        head: $head,
        body: $body,
    );
