# inky-premailer
ZURB Inky email templating Language + CssToInlineStyles CSS inliner is the perfect match for creating responsive emails.

### Thanks to
- Thampe for providing php implementation of Foundation for Email parser https://github.com/thampe/inky
- tijsverkoyen for making such a wonderful class to convert HTML into HTML with inline styles https://github.com/tijsverkoyen/CssToInlineStyles

## Installation
The recommended installation way is through [Composer](https://getcomposer.org).

```bash
$ composer require dreamvention/inky-premailer
```

or add the package to your `composer.json` file directly.

## Usage

```php
<?php
use Dreamvention\InkyPremailer\InkyPremailer;

$inkyPremailer = new InkyPremailer();

$html = '<html><head><style>body{ background:#ccc; } .hello{ color:red; }</style></head><body><div class="hello">Hello World</div></body></html>';

$email = $inkyPremailer->render($html);

echo $email;
```

### Add links to CSS files
You can also add links to CSS files either relative to your root folder or with full address.

```php
<?php
use Dreamvention\InkyPremailer\InkyPremailer;

$inkyPremailer = new InkyPremailer();

$html = '<html><head><style>body{ background:#ccc; } .hello{ color:red; }</style></head><body><div class="hello">Hello World</div></body></html>';

$links = array();
$links[] = 'css/style.css'; // this will override the styles in the template file.
$styles = '.header { background:#fff; }'; //this is the final styles that will overwrite all the others.
$html = file_get_contents('template/basic.html');

$email = $inkyPremailer->render($html, $links, $styles); 

echo $email;
```
### How CSS is rendered?

- First the styles in your html file are rendered.
- Then if you have added links to CSS, they will be rendered, rewriting styles added eariler. 

This sometimes may be tricky so just stick to one way of adding CSS - in the HTML template file or adding CSS links via php.

$links and $styles are optional

## License
See the [LICENSE](LICENSE) file for license info (it's the MIT license).