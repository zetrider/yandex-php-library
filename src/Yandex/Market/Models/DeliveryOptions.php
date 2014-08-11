<?php

namespace Yandex\Market\Models;

class DeliveryOptions extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($deliveryOption)
    {
        if (is_array($deliveryOption)) {
            $this->collection[] = new DeliveryOption($deliveryOption);
        } elseif (is_object($deliveryOption) && $deliveryOption instanceof DeliveryOption) {
            $this->collection[] = $deliveryOption;
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
