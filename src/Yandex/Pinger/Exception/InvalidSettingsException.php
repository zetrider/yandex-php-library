<?php
/**
 * @namespace
 */
namespace Yandex\Pinger\Exception;


/**
 * Invalid Settings
 *
 * Check settings on page {@link http://site.yandex.ru/searches/}
 *
 * @category Yandex
 * @package  Pinger
 *
 * @author   Anton Shevchuk
 * @created  24.07.13 17:47
 */
class InvalidSettingsException extends PingerException
{
    protected $message = "Settings is invalid. Please check 'Pinger' options: `key`, `login` and `searchId`";
}
