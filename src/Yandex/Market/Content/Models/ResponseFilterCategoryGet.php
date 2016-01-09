<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Base\PagedModel;

class ResponseFilterCategoryGet extends PagedModel
{
    protected $regionDelimiterPosition = null;

    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\SearchResults',
    );

    protected $propNameMap = array(
        'results' => 'items'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        parent::__construct($data['searchResult']);
    }

    /**
     * Retrieve the regionDelimiterPosition property
     *
     * @return int|null
     */
    public function getRegionDelimiterPosition()
    {
        return $this->regionDelimiterPosition;
    }
}
