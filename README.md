# Danky

> 🔔 Subscribe to the [newsletter](https://newsletter.chevereto.com/subscription?f=gTmksA6763vPCG763763kYCOTgWu6Kx4BPohVDY97aHddrqis6B763cHay8dhtmMKlI6r3vUfGREZmSvDNNGj3MlrRJV7A) to don't miss any update regarding Chevere.

![Chevere](chevere.svg)

[![Build](https://img.shields.io/github/workflow/status/chevere/danky/Test?style=flat-square)](https://github.com/chevere/danky/actions) ![Code size](https://img.shields.io/github/languages/code-size/chevere/danky?style=flat-square) [![Apache-2.0](https://img.shields.io/github/license/chevere/danky?style=flat-square)](LICENSE) [![PHPStan](https://img.shields.io/badge/PHPStan-level%209-blueviolet?style=flat-square)](https://phpstan.org/) [![Mutation testing badge](https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fchevere%2Fdanky%2F0.1)](https://dashboard.stryker-mutator.io/reports/github.com/chevere/danky/0.1)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=alert_status)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=security_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Coverage](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=coverage)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chevere_danky) [![CodeFactor](https://www.codefactor.io/repository/github/chevere/danky/badge)](https://www.codefactor.io/repository/github/chevere/danky) [![Codacy Badge](https://app.codacy.com/project/badge/Grade/00346c153d5842c88ee888b3d5339abc)](https://www.codacy.com/gh/chevere/danky/dashboard)

![Danky](.github/banner/danky-logo-sticker.webp)

## What is Danky?

Danky is a native template system for PHP. Contrary to all other template systems and engines, in Danky **templates are functions** provided as file returns.

🦄 In Danky, templates **explicit declare** its scope, parameters and `string` return type.

```php
<?php // quote.php

return function(string $text, string $author): string {
    return
        <<<HTML
        <quote>"$text" --$author</quote>
        HTML;
};
```

That `<<<HTML ...` is [heredoc](https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc) syntax [string literal](https://www.php.net/manual/en/language.types.string.php). In Danky, you use all the stuff that _has been always there_ to handle multi-line string literals. Heredoc is great for templates as it evaluates variables, making templates clean to read.

```php
<?php // home.php

return function(string $content): string {
    return
        <<<HTML
        <main>
            $content
        </main>
        HTML;
}
```

👽 Next, `import` which runs the template function.

```php
<?php // index.php

use function Chevere\Danky\import;

require_once __DIR__ . '/vendor/autoload.php';

echo
    import(
        'home',
        content: import(
            'quote',
            text: 'Hello, world!',
            author: 'Rodolfo'
        )
    );
```

🥳 **Congratulations**! You just mastered Danky.

```html
<main>
    <quote>"Hello, world!" --Rodolfo</quote>
</main>
```

## Danky motivation

PHP is an extraordinary language for templates, but it gets dirt when mixed with large non-PHP syntax. This problem drove development for template-syntax alternatives ([Twig](https://twig.symfony.com/), [Smarty](https://www.smarty.net/), [Latte](https://latte.nette.org/en/), etc.) where PHP gets either limited or stripped away. These systems where a reflection of its times, to how we used to build and published websites.

Danky use native PHP without requiring to learn a template syntax. Danky is like [Plates](https://platesphp.com/), but Danky is **stricter** as templates are typed, scooped under a function and highly testeable.

## Danky times

### Dead simple

Define your views and their variables. Simple to follow workflow, `import` all the things.

### No template engine

Danky doesn't use a template engine, it is just PHP template functions to HTML.

* Full PHP syntax support.
* Re-usable view-scooped templates.

### Strict

Danky templates are functions, with explicit variables declaration and returning `string`. Templates aren't just generics bytes.

* Templates can be easily tested.
* Strict runtime checking.

### Lightweight

Danky runs with very low dependencies and the codebase is tiny. You won't even notice that Danky is there.

* Lightweight footprint.

### Fast

Get started in minutes, simply install it and start crafting templates. No need to learn a new template syntax

* **Getting started** will take you less than 5 minutes.

## License

Copyright 2022 [Rodolfo Berrios A.](https://rodolfoberrios.com/)

Chevere is licensed under the Apache License, Version 2.0. See [LICENSE](LICENSE) for the full license text.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
