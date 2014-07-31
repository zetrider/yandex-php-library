<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Metrica\Management\Models\Filters;

class GetFiltersResponse extends ManagementModel
{

    protected $filters = null;

    protected $mappingClasses = array(
        'filters' => 'Yandex\Metrica\Management\Models\Filters'
    );

    protected $propNameMap = array(
        
    );

    /**
     * Retrieve the filters property
     *
     * @return Filters|null
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set the filters property
     *
     * @param Filters $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }
}
