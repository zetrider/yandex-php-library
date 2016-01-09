<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\ProductModel;
use Yandex\Common\Model;

class GetModelInfoResponse extends Model
{
    protected $time = -1;

    protected $model = null;

    protected $mappingClasses = array(
        'model' => 'Yandex\Market\Content\Models\ProductModelInfo',
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

    /**
     * Set the model property
     *
     * @param Model $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
