<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class TopVendors extends ObjectModel
{
    /**
     * Add item
     */
    public function add($vendor)
    {
        if (is_array($vendor)) {
            $this->collection[] = new TopVendor($vendor);
        } elseif (is_object($vendor) && $vendor instanceof TopVendor) {
            $this->collection[] = $vendor;
        }

        return $this;
    }

    /**
     * Get items
     */
    public function getAll()
    {
        return $this->collection;
    }
}
