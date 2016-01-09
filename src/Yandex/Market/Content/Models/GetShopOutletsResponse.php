<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetShopOutletsResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $outlet = null;

    protected $mappingClasses = array(
        'outlet' => 'Yandex\Market\Content\Models\Outlets'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['outlets']);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getOutlets()
    {
        return $this->outlet;
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
