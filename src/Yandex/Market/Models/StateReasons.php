<?php

namespace Yandex\Market\Models;

class StateReasons extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($stateReason)
    {
        if (is_array($stateReason)) {
            $this->collection[] = new StateReason($stateReason);
        } elseif (is_object($stateReason) && $stateReason instanceof StateReason) {
            $this->collection[] = $stateReason;
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
