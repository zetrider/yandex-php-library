<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class ProductModelChildren extends ObjectModel
{

    protected $collection = array(

    );

    protected $mappingClasses = array(

    );

    protected $propNameMap = array(

    );

    /**
     * Add photo
     */
    public function add($children)
    {
        d($children);

        if (is_array($children)) {
            $this->collection[] = new ProductModel($children);
        } elseif (is_object($children) && $children instanceof ProductModel) {
            $this->collection[] = $children;
        }

        return $this;
    }

    /**
     * Get items
     */
    public function getAll()
    {
        return $this->collection;
    }
}
