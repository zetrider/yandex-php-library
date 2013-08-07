<?php
/**
 * Example of usage Yandex\Pinger package
 * 
 * @author   Anton Shevchuk
 * @created  07.08.13 10:32
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

$pinger = new Yandex\Pinger\Pinger();

$pinger->key = "4211b2e2e68d561dada4817053613ac4d88b5f2c";
$pinger->login = "AntonShevchuk";
$pinger->searchId = "2067539";

try {
    $pinger->ping("http://anton.shevchuk.name/php/php-development-environment-under-macos/", date('U'));
    echo "OK";
} catch (\Exception $e) {
    echo nl2br($e->getMessage());
}
