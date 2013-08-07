<?php
/**
 * @namespace
 */
namespace Yandex\Pinger\Exception;


/**
 * Invalid IP Settings
 *
 * Check settings on page {@link http://site.yandex.ru/searches/}
 *
 * @category Yandex
 * @package  Pinger
 *
 * @author   Anton Shevchuk
 * @created  24.07.13 18:08
 */
class InvalidIpException extends PingerException
{
    protected $message = "Invalid IP address. Please check list of IP on page http://site.yandex.ru/searches/";
}
