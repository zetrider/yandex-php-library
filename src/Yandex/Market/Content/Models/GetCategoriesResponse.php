<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Base\PagedModel;

class GetCategoriesResponse extends PagedModel
{
    protected $items = null;

    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\Categories'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['categories']);
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
