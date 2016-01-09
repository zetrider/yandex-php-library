<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class TopCategories extends ObjectModel
{
    /**
     * Add item
     */
    public function add($category)
    {
        if (is_array($category)) {
            $this->collection[] = new TopCategory($category);
        } elseif (is_object($category) && $category instanceof TopCategory) {
            $this->collection[] = $category;
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
