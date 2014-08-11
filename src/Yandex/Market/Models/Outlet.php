<?php

namespace Yandex\Market\Models;

class Outlet extends MarketModel
{

    protected $id = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Retrieve the id property
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id property
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
