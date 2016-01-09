<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Base\Price;

class Prices extends Price
{
    protected $max = null;

    protected $min = null;

    protected $avg = null;

    protected $propNameMap = array(
        'curCode' => 'currencyCode',
        'curName' => 'currencyName',
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        parent::__construct($data);
        // @todo: create property propNameExcl?
        unset($this->value);
    }

    /**
     * @return null
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return null
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return null
     */
    public function getAvg()
    {
        return $this->avg;
    }
}
