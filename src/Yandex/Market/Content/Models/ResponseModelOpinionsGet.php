<?php

namespace Yandex\Market\Content\Models;

use Yandex\Market\Content\Models\Base\PagedModel;

class ResponseModelOpinionsGet extends PagedModel
{
    protected $mappingClasses = array(
        'items' => 'Yandex\Market\Content\Models\ModelOpinions'
    );

    protected $propNameMap = array(
        'opinion' => 'items',
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        parent::__construct($data['modelOpinions']);
    }
}
