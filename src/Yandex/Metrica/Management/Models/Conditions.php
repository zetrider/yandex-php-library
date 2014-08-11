<?php

namespace Yandex\Metrica\Management\Models;

class Conditions extends ManagementModel
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
    public function add($condition)
    {
        if (is_array($condition)) {
            $this->collection[] = new Condition($condition);
        } elseif (is_object($condition) && $condition instanceof Condition) {
            $this->collection[] = $condition;
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
