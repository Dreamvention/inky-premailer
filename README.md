# inky-premailer
Inky + CSS inliner. Simple integration. 



## Installation

```
$ composer require Dreamvention/Premailer
```

## Usage

```php
use Dreamvention\Premailer\Premailer;

$premailer = new Premailer();

$html = '<html><head><style>body{ background:#ccc; } .hello{ color:red; }</style></head><body><div class="hello">Hello World</div></body></html>';

$email = $premailer->render($html);
echo $email;
```

