<?php

use Bacon\Core\Bacon;

define('__ROOT__', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('__APP__', __ROOT__ . 'app' . DIRECTORY_SEPARATOR);
define('__PUB__', '//' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));

require __APP__ . 'config.php';
require __ROOT__ . 'vendor/autoload.php';

$app = new Bacon();