<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class ProductModels extends ObjectModel
{
    /**
     * Add item
     */
    public function add($model)
    {
        if (is_array($model)) {
            $this->collection[] = new ProductModel($model);
        } elseif (is_object($model) && $model instanceof ProductModel) {
            $this->collection[] = $model;
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
