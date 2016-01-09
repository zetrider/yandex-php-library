<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetFilterCategoryResponse extends Model
{
    protected $results = null;

    protected $mappingClasses = array(
        'results' => 'Yandex\Market\Content\Models\SearchResults',
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['searchResult']);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getResults()
    {
        return $this->results;
    }
}
