<?php

namespace Yandex\Metrica\Management\Models;

class Grants extends ManagementModel
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
    public function add($grant)
    {
        if (is_array($grant)) {
            $this->collection[] = new Grant($grant);
        } elseif (is_object($grant) && $grant instanceof Grant) {
            $this->collection[] = $grant;
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
