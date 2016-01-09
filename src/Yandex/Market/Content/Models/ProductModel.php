<?php

namespace Yandex\Market\Content\Models;

use Yandex\Common\Model;

class ProductModel extends Model
{
    protected $offersCount = -1;

    protected $rating = -1.0;

    protected $reviewsCount = -1;

    protected $articlesCount = -1;

    protected $isNew = 0;

    protected $vendorId = -1;

    protected $gradeCount = -1;

    protected $categoryId = -1;

    protected $id = -1;

    protected $photos = array();

    protected $link = '';

    protected $isGroup = false;

    protected $vendor = '';

    protected $name = '';

    protected $prices = null;

    protected $description = '';

    protected $facts = array();

    protected $mainPhoto = null;

    protected $children = array();

    protected $parentModel = null;


    protected $previewPhotos;

    protected $filters;

    protected $vendorName;

    protected $offers;

    protected $mappingClasses = array(
        'prices' => 'Yandex\Market\Content\Models\Prices',
        'mainPhoto' => 'Yandex\Market\Content\Models\ProductModelPhoto',
        'photos' => 'Yandex\Market\Content\Models\ProductModelPhotos',
        'previewPhotos' => 'Yandex\Market\Content\Models\ProductModelPhotos',

        'facts' => 'Yandex\Market\Content\Models\Facts',
        // ????
        'children' => 'Yandex\Market\Content\Models\ProductModelChildren',
        'parentModel' => 'Yandex\Market\Content\Models\ProductModel',
        'filters' => 'Yandex\Market\Content\Models\Filters',
    );

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
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
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return null
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return null
     */
    public function getMainPhoto()
    {
        return $this->mainPhoto;
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
    public function getVendorId()
    {
        return $this->vendorId;
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
    public function getVendor()
    {
        return $this->vendor;
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
    public function getGradeCount()
    {
        return $this->gradeCount;
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
    public function getArticlesCount()
    {
        return $this->articlesCount;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return null
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @return null
     */
    public function getPreviewPhotos()
    {
        return $this->previewPhotos;
    }

    /**
     * @return null
     */
    public function getChildren()
    {
        return $this->children;
    }

}
