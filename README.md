# Danky

> 🔔 Subscribe to the [newsletter](https://newsletter.chevereto.com/subscription?f=gTmksA6763vPCG763763kYCOTgWu6Kx4BPohVDY97aHddrqis6B763cHay8dhtmMKlI6r3vUfGREZmSvDNNGj3MlrRJV7A) to don't miss any update regarding Chevere.

![Chevere](chevere.svg)

[![Build](https://img.shields.io/github/workflow/status/chevere/danky/Test?style=flat-square)](https://github.com/chevere/danky/actions) ![Code size](https://img.shields.io/github/languages/code-size/chevere/danky?style=flat-square) [![Apache-2.0](https://img.shields.io/github/license/chevere/danky?style=flat-square)](LICENSE)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=alert_status)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=security_rating)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![Coverage](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=coverage)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=chevere_Danky&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chevere_Danky) [![CodeFactor](https://www.codefactor.io/repository/github/chevere/danky/badge)](https://www.codefactor.io/repository/github/chevere/danky) [![Codacy Badge](https://app.codacy.com/project/badge/Grade/b956754f8ff04aaa9ca24a6e4cc21661)](https://www.codacy.com/gh/chevere/danky/dashboard)

Danky is a static site generator (SSG) and templating system for PHP.

## Get Danky!

Contrary to all template engines, in Danky templates are **file returns**. This is Danky in action:

```php
// quote.php
return function(string $text, string $author): string {
    return
        <<<EOT
        <quote>"$text" --$author</quote>
        EOT;
};
```

```php
// home.php
use function Chevere\Danky\import;

$quote = import(
    'quote',
    text: 'O sea, yo la encuentro rica.',
    author: 'Redoles'
);

return
    <<<EOT
    <main>
        $quote
    </main>
    EOT;
```

```html
<main>
    <quote>"O sea, yo la encuentro rica." --Redoles</quote>
</main>
```

👽 Danky gets you higher when you realize that you can create **nested templates**.

## Why Danky?

Although PHP is an extraordinary language for templates, it gets dirt when it get mixed with HTML markup. This problem drove template-syntax driven alternatives (Twig, Smarty, Blade, etc.) where PHP get either limited or stripped away as a reflection of its times, to how we used to build websites.

Danky doesn't need a template language. It is like Plates as uses native PHP, but Danky is stricter as templates are typed, closed and testeable.

## Danky times

### Dead simple

Define your website routes, its route-scoped variables and the views.

* Creates `/paths` for your routes and bind views for it.
* Configure route redirects and more.

### No template engine

Danky doesn't use a template engine, it is just PHP to HTML.

* Full PHP syntax support.
* Re-usable view-scooped templates.
* No need to learn any template engine/syntax.

### Safe

Danky templates declares their signature for strong-typed checks. Templates can be easily tested, and Danky provides all the tooling to safely handle variables in these.

### Cheap

Danky runs with very low third-party dependencies and it generates HTML files which can be deployed to any webserver.

* Lightweight footprint.
* No need to hosting a complex dynamic website.

### Fast

Get started in minutes and start previewing website changes instantly as you develop. Also, production website generation is so darn fast!

* **Getting started** will take you less than 5 minutes.
* Preview your changes on-the-fly.
* Generate websites in seconds.

## License

Copyright 2022 [Rodolfo Berrios A.](https://rodolfoberrios.com/)

Chevere is licensed under the Apache License, Version 2.0. See [LICENSE](LICENSE) for the full license text.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
