<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class Opinion extends Model
{
    protected $id = -1;

    protected $agree = -1;

    protected $reject = -1;

    protected $grade = null;

    protected $anonymous = true;

    protected $authorInfo = null;

    protected $comments = array();

    protected $region = -1;

    protected $author = '';

    protected $pro = '';

    protected $text = '';

    protected $visibility = '';

    protected $problem = '';

    protected $contra = '';

    protected $date = null;

    protected $shopOrderId = -1;

    protected $delivery = '';

    protected $mappingClasses = array(
        'authorInfo' => 'Yandex\Market\Content\Models\OpinionAuthorInfo',
    );
}
