<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class GetReviewsResponse extends Model
{
    protected $page = null;

    protected $total = null;

    protected $count = null;

    protected $reviews = null;

    protected $mappingClasses = array(
        'reviews' => 'Yandex\Market\Content\Models\Reviews'
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->fromArray($data['modelReviews']);
    }

    /**
     * Retrieve the reviews property
     *
     * @return Reviews|null
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
