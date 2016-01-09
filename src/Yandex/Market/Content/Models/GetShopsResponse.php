<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetShopsResponse extends Model
{
    protected $time = null;

    protected $shops = null;

    protected $mappingClasses = array(
        'shops' => 'Yandex\Market\Content\Models\Shops'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getShops()
    {
        return $this->shops;
    }
}
