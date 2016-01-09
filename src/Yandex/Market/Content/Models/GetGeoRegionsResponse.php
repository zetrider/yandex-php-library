<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetGeoRegionsResponse extends Model
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

    /**
     * Set the categories property
     *
     * @param Categories $categories
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }
}
