<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class CategoryFilterOption extends Model
{
    protected $valueId = null;

    protected $valueText = null;

    protected $count = null;

    protected $popularity = null;

    protected $tag = null;

    protected $code = null;

    protected $unit = null;

    protected $unitName = null;

    public function getValueId()
    {
        return $this->valueId;
    }

    public function getValueText()
    {
        return $this->valueText;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getPopularity()
    {
        return $this->popularity;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function getUnitName()
    {
        return $this->unitName;
    }


}
