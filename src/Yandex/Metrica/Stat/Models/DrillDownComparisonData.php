<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Metrica\Stat\Models\ComparisonTotals;

class DrillDownComparisonData extends StatModel
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
    public function add($drillDownComparisonItems)
    {
        if (is_array($drillDownComparisonItems)) {
            $this->collection[] = new DrillDownComparisonItems($drillDownComparisonItems);
        } elseif (is_object($drillDownComparisonItems)
            && $drillDownComparisonItems instanceof DrillDownComparisonItems
        ) {
            $this->collection[] = $drillDownComparisonItems;
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
