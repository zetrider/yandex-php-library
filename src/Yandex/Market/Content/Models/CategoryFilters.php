<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class CategoryFilters extends ObjectModel
{
    /**
     * Add item
     */
    public function add($categoryFilter)
    {
        if (is_array($categoryFilter)) {
            $this->collection[] = new CategoryFilter($categoryFilter);
        } elseif (is_object($categoryFilter) && $categoryFilter instanceof CategoryFilter) {
            $this->collection[] = $categoryFilter;
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
