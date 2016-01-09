<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class TopCategory extends Model
{
    protected $id = -1;

    protected $name = '';

    protected $topVendors = array();

    protected $mappingClasses = array(
        'topVendors' => 'Yandex\Market\Content\Models\TopVendors'
    );
}
