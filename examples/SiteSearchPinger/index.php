<?php
/**
 * Example of usage Yandex\SiteSearchPinger package
 * 
 * @author   Anton Shevchuk
 * @created  07.08.13 10:32
 */

use Yandex\SiteSearchPinger\SiteSearchPinger;
use Yandex\SiteSearchPinger\Exception\SiteSearchPingerException;
use Yandex\Common\Exception\Exception;

$settings = require_once '../settings.php';

$pinger = new SiteSearchPinger();

$pinger->key = $settings["pinger"]["key"];
$pinger->login = $settings["pinger"]["login"];
$pinger->searchId = $settings["pinger"]["searchId"];

try {
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
} catch (SiteSearchPingerException $e) {
    echo "Site Search Pinger Exception<br/>";
    echo nl2br($e->getMessage());
} catch (Exception $e) {
    echo "Yandex SDK Exception<br/>";
    echo nl2br($e->getMessage());
} catch (\Exception $e) {
    echo get_class($e) . "<br/>";
    echo nl2br($e->getMessage());
}
