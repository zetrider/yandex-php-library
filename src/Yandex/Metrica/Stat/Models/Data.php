<?php

namespace Yandex\Metrica\Stat\Models;

class Data extends StatModel
{

    protected $collection = array(
        
    );

    protected $mappingClasses = array(
        
    );

    protected $propNameMap = array(
        
    );

    /**
     * Add item
     */
    public function add($items)
    {
        if (is_array($items)) {
            $this->collection[] = new Items($items);
        } elseif (is_object($items) && $items instanceof Items) {
            $this->collection[] = $items;
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
