# Danky

> 🔔 Subscribe to the [newsletter](https://newsletter.chevereto.com/subscription?f=gTmksA6763vPCG763763kYCOTgWu6Kx4BPohVDY97aHddrqis6B763cHay8dhtmMKlI6r3vUfGREZmSvDNNGj3MlrRJV7A) to don't miss any update regarding Chevere.

![Chevere](chevere.svg)

[![Build](https://img.shields.io/github/workflow/status/chevere/danky/Test?style=flat-square)](https://github.com/chevere/danky/actions) ![Code size](https://img.shields.io/github/languages/code-size/chevere/danky?style=flat-square) [![Apache-2.0](https://img.shields.io/github/license/chevere/danky?style=flat-square)](LICENSE)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=alert_status)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=security_rating)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Coverage](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=coverage)](https://sonarcloud.io/dashboard?id=chevere_danky) [![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chevere_danky) [![CodeFactor](https://www.codefactor.io/repository/github/chevere/danky/badge)](https://www.codefactor.io/repository/github/chevere/danky) [![Codacy Badge](https://app.codacy.com/project/badge/Grade/b956754f8ff04aaa9ca24a6e4cc21661)](https://www.codacy.com/gh/chevere/danky/dashboard)

![Danky](.github/banner/danky-logo-sticker.webp)

## What is Danky?

Danky is a template system for PHP. Contrary to all other template systems and engines, in Danky **templates are functions** provided as file returns.

✅ In Danky, templates **explicit declare** its scope and parameters.

```php
<?php // quote.php
return function(string $text, string $author): string {
    return
        <<<HTML
        <quote>"$text" --$author</quote>
        HTML;
};
```

👽 Danky hits you higher as you can create **nested templates**.

```php
<?php // home.php
use function Chevere\Danky\import;

return function(): string {
    $quote = import(
        'quote',
        text: 'Hello, world!',
        author: 'Rodolfo'
    );
    return <<<HTML
    <main>
        $quote
    </main>
    HTML;
}
```

🦄 Danky stuff are **simple strings**, wire it to your please.

```php
<?php // index.php
use function Chevere\Danky\import;

require_once __DIR__ . '/vendor/autoload.php';

echo import('home');
```

```html
<main>
    <quote>"Hello, world!" --Rodolfo</quote>
</main>
```

## Danky motivation

PHP is an extraordinary language for templates, but it gets dirt when mixed with large HTML markup. This problem drove development for template-syntax alternatives ([Twig](https://twig.symfony.com/), [Smarty](https://www.smarty.net/), [Latte](https://latte.nette.org/en/), etc.) where PHP get either limited or stripped away. These systems where a reflection of its times, to how we used to build and published websites.

Danky is on the [Plates](https://platesphp.com/) category, both use native PHP without requiring to learn a template syntax. But Danky is **stricter** as templates are typed, scooped under a function and highly testeable.

## Danky times

### Dead simple

Define your views, an entrypoint and `import` passing the variables.

* Simple to follow workflow.
* No extra magic.

### No template engine

Danky doesn't use a template engine, it is just PHP to HTML.

* Full PHP syntax support.
* Re-usable view-scooped templates.
* No need to learn any template syntax.

### Safe

Danky templates declares their signature for strong-typed checks.

* Templates can be easily tested.
* Strict runtime checking.

### Cheap

Danky runs with very low dependencies and it generates documents that can be used for any purpose.

* Lightweight footprint.
* Generate HTML and other types of markup.

### Fast

Get started in minutes and start previewing website changes instantly as you develop. Also, production website generation is so darn fast!

* **Getting started** will take you less than 5 minutes.
* Preview your changes on-the-fly.
* Generate documents in seconds.

## License

Copyright 2022 [Rodolfo Berrios A.](https://rodolfoberrios.com/)

Chevere is licensed under the Apache License, Version 2.0. See [LICENSE](LICENSE) for the full license text.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
