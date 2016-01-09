<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class CategoryFilterOptions extends ObjectModel
{
    /**
     * Add item
     */
    public function add($categoryFilterOption)
    {
        if (is_array($categoryFilterOption)) {
            $this->collection[] = new CategoryFilterOption($categoryFilterOption);
        } elseif (is_object($categoryFilterOption) && $categoryFilterOption instanceof CategoryFilterOption) {
            $this->collection[] = $categoryFilterOption;
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
