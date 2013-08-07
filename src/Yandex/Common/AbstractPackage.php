<?php
/**
 * @namespace
 */
namespace Yandex\Common;

use Yandex\Common\Exception\OptionsException;

/**
 * Package
 *
 * @category Yandex
 * @package  Common
 *
 * @author   Anton Shevchuk
 * @created  07.08.13 10:12
 */
abstract class AbstractPackage
{
    /**
     * __set
     *
     * @param string $key
     * @param mixed $value
     * @throws Exception\OptionsException
     * @return self
     */
    public function __set($key, $value)
    {
        $method = 'set' . ucfirst($key);

        if (method_exists($this, $method)) {
            $this->$method($value);
        } elseif (property_exists($this, $key)) {
            $this->$key = $value;
        } else {
            throw new OptionsException("Configuration option '$key' is undefined");
        }
        return $this;
    }

    /**
     * __get
     *
     * @param string $key
     * @throws Exception\OptionsException
     * @return self
     */
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);

        if (method_exists($this, $method)) {
            return $this->$method($key);
        } elseif (property_exists($this, $key)) {
            return $this->$key;
        } else {
            throw new OptionsException("Configuration option '$key' is undefined");
        }
    }

    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options)
    {
        // apply options
        foreach ($options as $key => $value) {
            $key = $this->normalizeKey($key);
            $this->$key = $value;
        }
    }

    /**
     * checkOptions
     *
     * @throws Exception\OptionsException
     * @return void
     */
    public function checkOptions()
    {
        if (!$this->doCheckOptions()) {
            throw new OptionsException("Invalid configuration options of '".get_class($this)."' package");
        }
    }

    /**
     * Check package configuration
     *
     * @return boolean
     */
    abstract protected function doCheckOptions();

    /**
     * @param $key
     * @return mixed
     */
    private function normalizeKey($key)
    {
        $option = str_replace('_', ' ', strtolower($key));
        $option = str_replace(' ', '', ucwords($option));
        return $option;
    }
}
