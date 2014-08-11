<?php

namespace Yandex\Market\Models;

class Outlets extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($outlet)
    {
        if (is_array($outlet)) {
            $this->collection[] = new Outlet($outlet);
        } elseif (is_object($outlet) && $outlet instanceof Outlet) {
            $this->collection[] = $outlet;
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
