<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class ProductModelOpinions extends ObjectModel
{
    /**
     * Add item
     */
    public function add($opinion)
    {
        if (is_array($opinion)) {
            $this->collection[] = new ProductModelOpinion($opinion);
        } elseif (is_object($opinion) && $opinion instanceof ProductModelOpinion) {
            $this->collection[] = $opinion;
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
