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

