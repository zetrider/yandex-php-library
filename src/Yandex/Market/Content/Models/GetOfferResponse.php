<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetOfferResponse extends Model
{
    protected $offer = null;

    protected $mappingClasses = array(
        'offer' => 'Yandex\Market\Content\Models\Offer'
    );

    /**
     * Retrieve the categories property
     *
     * @return Categories|null
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
