<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class ProductModelOpinion extends Model
{
    protected $grade = null;

    protected $agree = -1;

    protected $reject = -1;

    protected $id = -1;

    protected $anonymous = true;

    protected $authorInfo = null;

    protected $date = null;

    protected $author = '';

    protected $text = '';

    protected $contra = '';

    protected $pro = '';

    protected $region = -1;

    protected $visibility = '';

    protected $usageTime = -1;

    protected $priceGrade = null;

    protected $convenienceGrade = null;

    protected $qualityGrade = null;

    protected $mappingClasses = array(
        'authorInfo' => 'Yandex\Market\Content\Models\OpinionAuthorInfo',
    );
}
