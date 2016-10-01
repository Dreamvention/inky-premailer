<?php 

require '../vendor/autoload.php';

require '../src/InkyPremailer.php';

use Dreamvention\InkyPremailer\InkyPremailer;

$inkyPremailer = new InkyPremailer();

$styles = array();
$styles[] = 'css/style.css'; // this will override the styles in the template file.

$html = file_get_contents('template/basic.html');

$email = $inkyPremailer->render($html, $styles);

echo $email;