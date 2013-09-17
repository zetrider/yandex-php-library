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
    // list URLs to ping
    $url = array(
        "http://anton.shevchuk.name/php/php-development-environment-under-macos/",
        "http://anton.shevchuk.name/php/php-framework-bluz-update/",
        "http://ya.ru",
        "http://yandex.ru",
        "yaru",
        "yarus",
    );

    $added = $pinger->ping($url);

    echo "OK. ".$added." from ".sizeof($url)." urls was added to queue<br/>";

    if (sizeof($pinger->invalidUrls)) {
        echo "Invalid Urls:"."<br/>";
        foreach ($pinger->invalidUrls as $url => $reason) {
            echo $url ." - ".$reason."<br/>";
        }
    }
} catch (\Exception $e) {
    echo get_class($e) . "<br/>";
    echo nl2br($e->getMessage());
}