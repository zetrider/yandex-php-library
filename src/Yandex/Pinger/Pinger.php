<?php
/**
 * @namespace
 */
namespace Yandex\Pinger;

use Yandex\Common\AbstractPackage;

/**
 * Pinger
 *
 * @category Yandex
 * @package  Pinger
 *
 * @property string $key
 * @property string $login
 * @property string $searchId
 *
 * @author   Anton Shevchuk
 * @created  06.08.13 17:30
 */
class Pinger extends AbstractPackage
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $searchId;

    /**
     * doCheckOptions
     *
     * @return boolean
     */
    protected function doCheckOptions()
    {
        return $this->key && $this->login && $this->searchId;
    }
}
