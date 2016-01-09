<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetOutletsResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $outlet = null;

    protected $mappingClasses = array(
        'outlet' => 'Yandex\Market\Content\Models\Outlets'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['outlets']);
    }

    /**
     * Retrieve the outlets property
     *
     * @return Outlets|null
     */
    public function getOutlets()
    {
        return $this->outlet;
    }
}
