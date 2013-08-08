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

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=http://anton.shevchuk.name/php/php-framework-bluz-update/
// 200
// <pings><added count="1"><url>http://anton.shevchuk.name/php/php-framework-bluz-update/</url></added></pings>

// wrong IP
// 400
// <errors><error code=""><code>USER_NOT_PERMITTED</code><message>User IP address is not equal to one specified in search properties</message><param>ip</param><value>91.208.153.1</value></error></errors>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk1&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=http://anton.shevchuk.name/php/php-framework-bluz-update/
// 400
// <errors><error code="34"><code>NO_SUCH_USER_IN_PASSPORT</code><message>No such user in Yandex.Passport. No such user corresponds to given login: AntonShevchuk1</message></error></errors>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=20675391&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=http://anton.shevchuk.name/php/php-framework-bluz-update/
// 400
// <errors><error code="11"><code>SEARCH_NOT_OWNED_BY_USER</code><message>Search does not exist or is not owned by the user</message><param>login</param><value>28303679</value><param>search_id</param><value>20675391</value></error></errors>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c1&urls=http://anton.shevchuk.name/php/php-framework-bluz-update/
// 400
// <errors><error code=""><code>USER_NOT_PERMITTED</code><message>Wrong secure key</message><param>key</param><value>4211b2e2e68d561dada4817053613ac4d88b5f2c1</value></error></errors>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=http://shevchuk.name/
// 200
// <pings><invalid count="1" reason="OUT_OF_SEARCH_AREA"><url>http://shevchuk.name/</url></invalid></pings>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=name
// 200
// <pings><invalid count="1" reason="MALFORMED_URLS"><url>http://name</url></invalid></pings>

// http://site.yandex.ru/ping.xml?login=AntonShevchuk&search_id=2067539&key=4211b2e2e68d561dada4817053613ac4d88b5f2c&urls=
// 200
// <empty-param>urls</empty-param>

// mixed request
/*
<pings>
    <added count="2">
        <url>http://anton.shevchuk.name/php/php-development-environment-under-macos/</url>
        <url>http://anton.shevchuk.name/php/php-framework-bluz-update/</url>
    </added>
    <invalid count="2" reason="MALFORMED_URLS">
        <url>http://yaru</url>
        <url>http://yarus</url>
    </invalid>
    <invalid count="2" reason="OUT_OF_SEARCH_AREA">
        <url>http://www.yandex.ru</url>
        <url>http://www.ya.ru</url>
    </invalid>
</pings>
*/