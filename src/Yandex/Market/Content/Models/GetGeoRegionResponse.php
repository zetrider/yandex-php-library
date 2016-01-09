<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetGeoRegionResponse extends Model
{
    protected $georegion = null;

    protected $mappingClasses = array(
        'georegion' => 'Yandex\Market\Content\Models\GeoRegion'
    );

    /**
     * Retrieve the geo region property
     *
     * @return GeoRegion|null
     */
    public function getGeoRegion()
    {
        return $this->georegion;
    }
}
