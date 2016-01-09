<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetSearchResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $regionDelimiterPosition = null;

    protected $results = null;

    protected $categories = null;

    protected $requestParams = null;

    protected $mappingClasses = array(
        'results' => 'Yandex\Market\Content\Models\SearchResults',
        'categories' => 'Yandex\Market\Content\Models\Categories',
        'requestParams' => 'Yandex\Market\Content\Models\SearchRequestParams',
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
