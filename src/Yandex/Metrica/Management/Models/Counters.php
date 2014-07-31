<?php

namespace Yandex\Metrica\Management\Models;

class Counters extends ManagementModel
{

    protected $rows = null;

    protected $collection = array(
        
    );

    protected $mappingClasses = array(
        
    );

    protected $propNameMap = array(
        
    );

    /**
     * Retrieve the rows property
     *
     * @return int|null
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Set the rows property
     *
     * @param int $rows
     * @return $this
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * Add item
     */
    public function add($counterItem)
    {
        if (is_array($counterItem)) {
            $this->collection[] = new CounterItem($counterItem);
        } elseif (is_object($counterItem) && $counterItem instanceof CounterItem) {
            $this->collection[] = $counterItem;
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
