<?php

namespace Yandex\Market\Models;

use Yandex\Market\Models\AcceptOrder;

class PostOrderAcceptResponse extends MarketModel
{

    protected $order = null;

    protected $mappingClasses = array(
        'order' => 'Yandex\Market\Models\AcceptOrder'
    );

    /**
     * Retrieve the order property
     *
     * @return AcceptOrder|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the order property
     *
     * @param AcceptOrder $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
}
