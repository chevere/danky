# Danky

> 🔔 Subscribe to the [newsletter](https://chv.to/chevere-newsletter) to don't miss any update regarding Chevere.

![Chevere](chevere.svg)

[![Build](https://img.shields.io/github/actions/workflow/status/chevere/danky/test.yml?branch=0.3&style=flat-square)](https://github.com/chevere/danky/actions)
![Code size](https://img.shields.io/github/languages/code-size/chevere/danky?style=flat-square)
[![Apache-2.0](https://img.shields.io/github/license/chevere/danky?style=flat-square)](LICENSE)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%209-blueviolet?style=flat-square)](https://phpstan.org/)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fchevere%2Fdanky%2F0.3)](https://dashboard.stryker-mutator.io/reports/github.com/chevere/danky/0.3)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=alert_status)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=security_rating)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=coverage)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=chevere_danky&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chevere_danky)
[![CodeFactor](https://www.codefactor.io/repository/github/chevere/danky/badge)](https://www.codefactor.io/repository/github/chevere/danky)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b956754f8ff04aaa9ca24a6e4cc21661)](https://www.codacy.com/gh/chevere/danky/dashboard)

![Danky](.github/banner/danky-logo.svg)

## What is Danky?

Danky is a typed template system for PHP. Contrary to all other template systems, in Danky **templates are classes**.

🦄 Templates **explicit declare** its scope on construct, the `$render` property can be of type `string` or `Template`.

```php
<?php // Quote.php

use Chevere\Danky\Template;

class Quote extends Template
{
    public function __construct(string $text, string $author) {
        $this->render =
            <<<HTML
            <quote>"$text" --$author</quote>
            HTML;
    }
};
```

That `<<<HTML ...` is [Heredoc](https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc) syntax [string literal](https://www.php.net/manual/en/language.types.string.php). In Danky, you use all the stuff that _has been always there_ to handle multi-line string literals. Heredoc is great for templates as it evaluates variables, making templates clean to read.

```php
<?php // Home.php

use Chevere\Danky\Template;

class Home extends Template
{
    public function __construct(Template $content) {
        $this->render =
            <<<HTML
            <main>
                $content
            </main>
            HTML;
    }
};
```

`Template` classes implements `Stringable`, you can use any template object within string literals.

```php
<?php // index.php

use function Chevere\Danky\import;
use Home;
use Quote;

echo
    new Home(
        content: new Quote(
            text: 'Hello, world!',
            author: 'Rodolfo'
        )
    );
```

🥳 **Congratulations**! You just mastered Danky.

```html
<main>
    <quote>"Hello, world!"</quote>
</main>
```

Now run `php demo/index.php` for a more complete example.

## License

Copyright 2022 [Rodolfo Berrios A.](https://rodolfoberrios.com/)

Chevere is licensed under the Apache License, Version 2.0. See [LICENSE](LICENSE) for the full license text.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
