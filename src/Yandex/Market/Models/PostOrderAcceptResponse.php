<?php

namespace Yandex\Market\Models;

use Yandex\Market\Models\AcceptOrder;
use Yandex\Common\Model;

class PostOrderAcceptResponse extends Model
{

    protected $order = null;

    protected $mappingClasses = [
        'order' => 'Yandex\Market\Models\AcceptOrder'
    ];

    protected $propNameMap = [];

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
