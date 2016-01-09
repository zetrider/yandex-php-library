<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class ResponseModelGet extends Model
{
    protected $model = null;

    protected $mappingClasses = array(
        'model' => 'Yandex\Market\Content\Models\Base\MarketModel',
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    function __construct($data=array())
    {
        foreach($this->mappingClasses as $propName=>&$mappingClassName) {
            if ($mappingClassName == 'Yandex\Market\Content\Models\Base\MarketModel') {
                $realMappingClassName = \Yandex\Market\Content\Models\Base\MarketModel::getInstanceClassName($data[$propName]);
                $mappingClassName = $realMappingClassName;
            }
        }
        parent::__construct($data);
    }

    /**
     * Retrieve the model property
     *
     * @return ProductModel|null
     */
    public function getModel()
    {
        return $this->model;
    }
}
