<?php

namespace Yandex\Market\Models;

class Orders extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($order)
    {
        if (is_array($order)) {
            $this->collection[] = new Order($order);
        } elseif (is_object($order) && $order instanceof Order) {
            $this->collection[] = $order;
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
