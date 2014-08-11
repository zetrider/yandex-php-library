<?php

namespace Yandex\Market\Models;

class Campaigns extends MarketModel
{

    protected $collection = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Add item
     */
    public function add($campaign)
    {
        if (is_array($campaign)) {
            $this->collection[] = new Campaign($campaign);
        } elseif (is_object($campaign) && $campaign instanceof Campaign) {
            $this->collection[] = $campaign;
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
