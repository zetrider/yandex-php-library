<?php

namespace Yandex\Market\Models;

class Items extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($item)
    {
        if (is_array($item)) {
            $this->collection[] = new Item($item);
        } elseif (is_object($item) && $item instanceof Item) {
            $this->collection[] = $item;
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
