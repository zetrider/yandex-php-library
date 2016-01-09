<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetModelmatchResponse extends Model
{
    protected $time = -1;

    protected $model = null;

    protected $mappingClasses = array(
        'model' => 'Yandex\Market\Content\Models\ProductModel',
    );

    protected $propNameMap = array(

    );

    /**
     * Retrieve the model property
     *
     * @return Model|null
     */
    public function getModel()
    {
        return $this->model;
    }
}
