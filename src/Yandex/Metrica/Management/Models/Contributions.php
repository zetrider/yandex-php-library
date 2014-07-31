<?php

namespace Yandex\Metrica\Management\Models;

class Contributions extends ManagementModel
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
    public function add($contribution)
    {
        if (is_array($contribution)) {
            $this->collection[] = new Contribution($contribution);
        } elseif (is_object($contribution) && $contribution instanceof Contribution) {
            $this->collection[] = $contribution;
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
