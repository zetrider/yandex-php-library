<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\ObjectModel;

class ProductModelPhotos extends ObjectModel
{

    protected $collection = array(

    );

    protected $mappingClasses = array(

    );

    protected $propNameMap = array(

    );

    /**
     * Add photo
     */
    public function add($photo)
    {
        if (is_array($photo)) {
            $this->collection[] = new ProductModelPhoto($photo);
        } elseif (is_object($photo) && $photo instanceof ProductModelPhoto) {
            $this->collection[] = $photo;
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
