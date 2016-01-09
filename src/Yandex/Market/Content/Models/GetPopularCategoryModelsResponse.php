<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetPopularCategoryModelsResponse extends Model
{
    protected $topCategoryList = null;

    protected $mappingClasses = array(
        'topCategoryList' => 'Yandex\Market\Content\Models\TopCategories'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['popular']);
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
