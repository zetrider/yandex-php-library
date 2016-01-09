<?php

namespace Yandex\Market\Content\Models\Base;

class Model extends MarketModel
{
    protected $categoryId = null;

    protected $description = null;

    protected $gradeCount = null;

    protected $articlesCount = null;

    protected $offersCount = null;

    protected $reviewsCount = null;

    protected $isGroup = null;

    protected $isNew = null;

    protected $rating = null;

    protected $link = null;

    protected $facts = null;

    protected $mainPhoto = null;

    protected $propNameMap = array(
        'vendor' => 'vendorName'
    );

    protected $mappingClasses = array(
        'facts' => 'Yandex\Market\Content\Models\Facts',
        'mainPhoto' => 'Yandex\Market\Content\Models\ProductModelPhoto',
    );

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct($data = array())
    {


        parent::__construct($data);
    }

    /**
     * @return null
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null
     */
    public function getGradeCount()
    {
        return $this->gradeCount;
    }

    /**
     * @return null
     */
    public function getArticlesCount()
    {
        return $this->articlesCount;
    }

    /**
     * @return null
     */
    public function getOffersCount()
    {
        return $this->offersCount;
    }

    /**
     * @return null
     */
    public function getReviewsCount()
    {
        return $this->reviewsCount;
    }

    /**
     * @return null
     */
    public function getIsGroup()
    {
        return $this->isGroup;
    }

    /**
     * @return null
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     * @return null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return null
     */
    public function getFacts()
    {
        return $this->facts;
    }

    /**
     * @return null
     */
    public function getMainPhoto()
    {
        return $this->mainPhoto;
    }
}
