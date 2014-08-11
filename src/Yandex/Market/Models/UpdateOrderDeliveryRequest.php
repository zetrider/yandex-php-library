<?php

namespace Yandex\Market\Models;

use Yandex\Market\Models\Delivery;

class UpdateOrderDeliveryRequest extends MarketModel
{

    protected $delivery = null;

    protected $mappingClasses = array(
        'delivery' => 'Yandex\Market\Models\Delivery'
    );

    /**
     * Retrieve the delivery property
     *
     * @return Delivery|null
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set the delivery property
     *
     * @param Delivery $delivery
     * @return $this
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }
}
