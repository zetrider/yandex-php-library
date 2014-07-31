<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Metrica\Stat\Models\ComparisonTotals;

class ComparisonData extends StatModel
{

    protected $collection = array(
        
    );

    protected $totals = null;

    protected $mappingClasses = array(
        'totals' => 'Yandex\Metrica\Stat\Models\ComparisonTotals'
    );

    protected $propNameMap = array(
        
    );

    /**
     * Add item
     */
    public function add($comparisonItems)
    {
        if (is_array($comparisonItems)) {
            $this->collection[] = new ComparisonItems($comparisonItems);
        } elseif (is_object($comparisonItems) && $comparisonItems instanceof ComparisonItems) {
            $this->collection[] = $comparisonItems;
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

    /**
     * Retrieve the totals property
     *
     * @return ComparisonTotals|null
     */
    public function getTotals()
    {
        return $this->totals;
    }

    /**
     * Set the totals property
     *
     * @param ComparisonTotals $totals
     * @return $this
     */
    public function setTotals($totals)
    {
        $this->totals = $totals;
        return $this;
    }
}
