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

return function (string $head, string $body, string $lang = 'en'): string {
    $headTag = import('head', head: $head);
    $bodyTag = import('body', body: $body);

    return <<<HTML
    <!DOCTYPE html>
    <html lang="$lang">
    $headTag
    $bodyTag
    </html>
    HTML;
};
