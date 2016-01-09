<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class CategoryFilter extends Model
{
    protected $id = null;

    protected $name = null;

    protected $shortname = null;

    protected $type = null;

    protected $hasBoolNo = null;

    protected $subType = null;

    protected $description = null;

    protected $unit = null;

    protected $exactly = null;

    protected $minValue = null;

    protected $maxValue = null;

    protected $options = null;

    protected $mappingClasses = array(
        'options' => 'Yandex\Market\Content\Models\CategoryFilterOptions',
    );

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getShortName()
    {
        return $this->shortname;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getHasBoolNo()
    {
        return $this->hasBoolNo;
    }

    public function getSubType()
    {
        return $this->subType;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function getExactly()
    {
        return $this->exactly;
    }

    public function getMinValue()
    {
        return $this->minValue;
    }

    public function getMaxValue()
    {
        return $this->maxValue;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
