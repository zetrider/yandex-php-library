<?php

namespace Yandex\Market\Models;

class DatesRange extends MarketModel
{

    protected $fromDate = null;

    protected $toDate = null;

    protected $mappingClasses = array(
        
    );

    /**
     * Retrieve the fromDate property
     *
     * @return string|null
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set the fromDate property
     *
     * @param string $fromDate
     * @return $this
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
        return $this;
    }

    /**
     * Retrieve the toDate property
     *
     * @return string|null
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set the toDate property
     *
     * @param string $toDate
     * @return $this
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
        return $this;
    }
}
