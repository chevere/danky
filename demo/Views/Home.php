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

namespace Chevere\Danky\Demo\Views;

use Chevere\Danky\Demo\Views\Common\Html;
use Chevere\Danky\Template;

class Home extends Template
{
    public function __construct(Template $header, Template $footer)
    {
        $title = 'Home';
        $head = <<<HTML
            <link rel="stylesheet" href="/web/css/home.css">
        HTML;
        $body = <<<HTML
        $header
            <main>$title</main>
        $footer
        HTML;

        $this->render = new Html(
            head: $head,
            body: $body,
            lang: 'en'
        );
    }
}
