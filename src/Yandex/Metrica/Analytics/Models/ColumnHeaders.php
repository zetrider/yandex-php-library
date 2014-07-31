<?php

namespace Yandex\Metrica\Analytics\Models;

class ColumnHeaders extends AnalyticsModel
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
    public function add($header)
    {
        if (is_array($header)) {
            $this->collection[] = new Header($header);
        } elseif (is_object($header) && $header instanceof Header) {
            $this->collection[] = $header;
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
