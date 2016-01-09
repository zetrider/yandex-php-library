<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class Price extends Model
{
    protected $currencyName = null;

    protected $currencyCode = null;

    protected $discount = null;

    protected $base = null;

    protected $value;
}
