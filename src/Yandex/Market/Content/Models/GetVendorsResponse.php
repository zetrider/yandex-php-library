<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetVendorsResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $vendor = null;

    protected $mappingClasses = array(
        'vendor' => 'Yandex\Market\Content\Models\Vendors'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['vendorList']);
    }

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getVendors()
    {
        return $this->vendor;
    }
}
