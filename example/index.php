<?php 

require '../vendor/autoload.php';

require '../src/InkyPremailer.php';

use Dreamvention\InkyPremailer\InkyPremailer;

$inkyPremailer = new InkyPremailer();

$links = array();
$links[] = 'css/style.css'; // this will override the styles in the template file.
$styles = '.header { background:#fff; }';
$html = file_get_contents('template/basic.html');

$email = $inkyPremailer->render($html, $links, $styles);

echo $email;