<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */

/**
 * @namespace
 */
namespace Yandex\Dictionary;

/**
 * Class DictionaryItem
 *
 * @category Yandex
 * @package  Dictionary
 *
 * @author   Nikolay Oleynikov <oleynikovny@mail.ru>
 * @created  07.11.14 20:38
 */
class DictionaryItem
{

    /**
     * @var
     */
    protected $text;

    /**
     * @var
     */
    protected $position;

    /**
     *
     */
    public function __construct($item)
    {
        if (isset($item->text)){
            $this->text = $item->text;
        }

        if (isset($item->pos)){
            $this->position = $item->pos;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getText();
    }

    /**
     *  @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     *  @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
}
