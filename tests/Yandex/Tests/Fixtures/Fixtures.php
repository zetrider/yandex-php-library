<?php
/**
 * @namespace
 */
namespace Yandex\Tests\Fixtures;

use Yandex\Common\AbstractPackage;

/**
 * Fixtures
 *
 * @category Yandex
 * @package  Tests
 *
 * @author   Anton Shevchuk
 * @created  07.08.13 11:48
 */
class Fixtures extends AbstractPackage
{
    protected $foo;

    protected $bar;

    /**
     * setBar
     *
     * @param $value
     * @return self
     */
    public function setBar($value)
    {
        $this->bar = $value;
        return $this;
    }

    /**
     * getBar
     *
     * @return mixed
     */
    public function getBar()
    {
        return $this->bar;
    }

    /**
     * doCheckOptions
     *
     * @return boolean
     */
    protected function doCheckOptions()
    {
        return $this->foo && $this->bar;
    }
}
