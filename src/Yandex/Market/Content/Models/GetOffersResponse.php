<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Offers;
use Yandex\Common\Model;

class GetOffersResponse extends Model
{

    protected $offers = null;

    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\Offers'
    );

    protected $propNameMap = array(

    );

    /**
     * Retrieve the offers property
     *
     * @return Categories|null
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Set the offers property
     *
     * @param Offers $offers
     * @return $this
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
        return $this;
    }
}
