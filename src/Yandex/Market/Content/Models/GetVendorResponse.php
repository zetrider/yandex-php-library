<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetVendorResponse extends Model
{
    protected $time = null;

    protected $vendor = null;

    protected $mappingClasses = array(
        'vendor' => 'Yandex\Market\Content\Models\Vendor'
    );

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getVendor()
    {
        return $this->vendor;
    }
}
