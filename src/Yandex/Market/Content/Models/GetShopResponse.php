<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetShopResponse extends Model
{
    protected $shop = null;

    protected $mappingClasses = array(
        'shop' => 'Yandex\Market\Content\Models\Shop',
    );

    /**
     * Retrieve the model property
     *
     * @return Model|null
     */
    public function getShop()
    {
        return $this->shop;
    }
}
