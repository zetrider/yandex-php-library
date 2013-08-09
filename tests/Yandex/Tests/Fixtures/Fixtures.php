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
 * @property integer $bar
 * @property integer $foo
 *
 * @author   Anton Shevchuk
 * @created  07.08.13 11:48
 */
class Fixtures extends AbstractPackage
{
    protected $bar;

    protected $foo;

    protected $readOnly = "OK";

    protected $writeOnly = "OK";

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
     * setFoo
     *
     * @param $value
     * @return self
     */
    public function setFoo($value)
    {
        $this->foo = $value + $value;
        return $this;
    }

    /**
     * getBar
     *
     * @return mixed
     */
    public function getFoo()
    {
        return $this->foo + $this->foo;
    }

    /**
     * getReadOnly
     *
     * @return string
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * setWriteOnly
     *
     * @param $value
     * @return string
     */
    public function setWriteOnly($value)
    {
        return $this->writeOnly = $value;
    }

    /**
     * doCheckOptions
     *
     * @return boolean
     */
    protected function doCheckSettings()
    {
        return $this->foo && $this->bar;
    }
}
