<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetGeoRegionSuggestResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $items = null;

    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\GeoRegions'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['georegions']);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getItems()
    {
        return $this->items;
    }
}
