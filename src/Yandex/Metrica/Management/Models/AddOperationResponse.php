<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Metrica\Management\Models\Operation;

class AddOperationResponse extends ManagementModel
{

    protected $operation = null;

    protected $mappingClasses = array(
        'operation' => 'Yandex\Metrica\Management\Models\Operation'
    );

    protected $propNameMap = array(
        
    );

    /**
     * Retrieve the operation property
     *
     * @return Operation|null
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set the operation property
     *
     * @param Operation $operation
     * @return $this
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }
}
