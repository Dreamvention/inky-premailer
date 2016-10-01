# inky-premailer
Inky + CSS inliner. Simple integration. 



## Installation

```
$ composer require dreamvention/inky-premailer
```

## Usage

```php
use Dreamvention\InkyPremailer\InkyPremailer;

$inkyPremailer = new InkyPremailer();

$html = '<html><head><style>body{ background:#ccc; } .hello{ color:red; }</style></head><body><div class="hello">Hello World</div></body></html>';

$email = $inkyPremailer->render($html);

echo $email;
```

