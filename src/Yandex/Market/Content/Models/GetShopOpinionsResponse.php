<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetShopOpinionsResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $opinion = null;

    protected $mappingClasses = array(
        'opinion' => 'Yandex\Market\Content\Models\Opinions'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['shopOpinions']);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getOpinions()
    {
        return $this->opinion;
    }
}
