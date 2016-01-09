<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class ProductModelInfo extends Model
{
    protected $id = -1;

    protected $offerCount = -1;

    protected $type = '';

    protected $name = '';

    protected $category = null;

    protected $price = null;

    protected $photo = '';

    protected $vendor = null;

    protected $rating = -1.0;

    protected $media;

    protected $facts = array();

    protected $mappingClasses = array(
        'category' => 'Yandex\Market\Content\Models\Category',
        'vendor' => 'Yandex\Market\Content\Models\Vendor',
    );

    protected $propNameMap = array(
        //'id' => 'nid',
    );
}
