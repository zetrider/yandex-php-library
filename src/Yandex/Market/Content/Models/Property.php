<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class Property extends Model
{
    protected $longName = null;

    protected $description = null;

    protected $propNameMap = array(
        'longname' => 'longName'
    );

    public function getLongName()
    {
        return $this->longName;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
