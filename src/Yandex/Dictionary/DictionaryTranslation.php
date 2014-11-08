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

use Yandex\Dictionary\DictionaryItem;
use Yandex\Dictionary\DictionaryExample;

/**
 * Class DictionaryTranslation
 *
 * @category Yandex
 * @package  Dictionary
 *
 * @author   Nikolay Oleynikov <oleynikovny@mail.ru>
 * @created  07.11.14 20:05
 */
class DictionaryTranslation extends DictionaryItem
{

    /**
     * @var
     */
    protected $synonyms = array();

    /**
     * @var
     */
    protected $meanings = array();

    /**
     * @var
     */
    protected $examples = array();

    /**
     *
     */
    public function __construct($translation)
    {
        parent::__construct($translation);

        if (isset($translation->syn)){
            foreach ($translation->syn as $synonym){
                $this->synonyms[] = new DictionaryItem($synonym);
            }
        }

        if (isset($translation->mean)){
            foreach ($translation->mean as $meaning){
                $this->meanings[] = new DictionaryItem($meaning);
            }
        }

        if (isset($translation->ex)){
            foreach ($translation->ex as $example){
                $this->examples[] = new DictionaryExample($example);
            }
        }
    }

    /**
     *  @return string
     */
    public function getSynonyms()
    {
        return $this->synonyms;
    }

    /**
     *  @return string
     */
    public function getMeanings()
    {
        return $this->meanings;
    }

    /**
     *  @return string
     */
    public function getExamples()
    {
        return $this->examples;
    }
}
