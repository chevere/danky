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

class Html extends Template
{
    public function __construct(
        string $head,
        string $body,
        string $lang = 'en'
    ) {
        $headTag = new Head(head: $head);
        $bodyTag = new Body(body: $body);

        $this->render =
            <<<HTML
            <!DOCTYPE html>
            <html lang="$lang">
            $headTag
            $bodyTag
            </html>
            HTML;
    }
}
