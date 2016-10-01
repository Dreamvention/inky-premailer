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
### Inky templating Language
It's really an awesome thing what ZUBR huys have done with inky. Instead of counting all thos td's and tr's you now have a dosen of tags and a clean markup.

This is HTML that an email uses to be responsive. Madness, right.
```html
<table align="center" class="container">
  <tbody>
    <tr>
      <td>
        <table class="row">
          <tbody>
            <tr>
              <th class="small-12 large-12 columns first last">
                <table>
                  <tr>
                    <th>Put content in me!</th>
                    <th class="expander"></th>
                  </tr>
                </table>
              </th>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
```
And this is Inky markup
```html
<container>
  <row>
    <columns>Put content in me!</columns>
  </row>
</container>
```
If you want to start right away using inky go [here](http://foundation.zurb.com/emails/docs/inky.html)

Try the [example](example) or use ready made (templates)[http://foundation.zurb.com/emails/email-templates.html] from Froundation.

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