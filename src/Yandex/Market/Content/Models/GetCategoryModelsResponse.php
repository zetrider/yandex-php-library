<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Base\PagedModel;

class GetCategoryModelsResponse extends PagedModel
{
    protected $items = null;

    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\ProductModels'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['models']);
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
