<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class Opinions extends ObjectModel
{
    /**
     * Add item
     */
    public function add($opinion)
    {
        if (is_array($opinion)) {
            $this->collection[] = new Opinion($opinion);
        } elseif (is_object($opinion) && $opinion instanceof Opinion) {
            $this->collection[] = $opinion;
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
