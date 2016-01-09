<?php
/**
 * @namespace
 */
namespace Yandex\Tests\Market;

use Guzzle\Http\Message\Response;
use Yandex\Tests\TestCase;

/**
 * PackageTest
 *
 * @category Yandex
 * @package  Tests
 *
 * @author   Oleg Scherbakov <holdmann@yandex.ru>
 * @created  03.01.2016 17:31
 */
class CategoryTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    function testGetCategories()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/categories.json');
        $jsonObj = json_decode($json);
        $response = new Response(200);
        $response->setBody($json);

        $marketPartnerMock = $this->getMock('Yandex\Market\Content\ContentClient', array('sendRequest'));
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $categories = $marketPartnerMock->getCategories(array('geo_id' => 213, 'sort' => 'name'));

        $this->assertEquals(
            $jsonObj->categories->count,
            $categories->getCount()
        );

        $this->assertEquals(
            $jsonObj->categories->total,
            $categories->getTotal()
        );

        $this->assertEquals(
            $jsonObj->categories->page,
            $categories->getPage()
        );

        $items = $categories->getItems();

        /** @var Item $item0 */
        $item0 = $items->current();
        $this->assertEquals(
            $jsonObj->categories->items[0]->id,
            $item0->getId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->name,
            $item0->getName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->uniqName,
            $item0->getUniqueName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->parentId,
            $item0->getParentId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->childrenCount,
            $item0->getChildrenCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->offersNum,
            $item0->getOffersCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->modelsNum,
            $item0->getModelsCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->visual,
            $item0->getIsVisual()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->type,
            $item0->getType()
        );

        /** @var Item $item1 */
        $item1 = $items->next();
        $this->assertEquals(
            $jsonObj->categories->items[1]->id,
            $item1->getId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->name,
            $item1->getName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->uniqName,
            $item1->getUniqueName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->parentId,
            $item1->getParentId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->childrenCount,
            $item1->getChildrenCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->offersNum,
            $item1->getOffersCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->modelsNum,
            $item1->getModelsCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->visual,
            $item1->getIsVisual()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->type,
            $item1->getType()
        );
    }

    function testGetCategory()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/category.json');
        $jsonObj = json_decode($json);
        $response = new Response(200);
        $response->setBody($json);

        $marketPartnerMock = $this->getMock('Yandex\Market\Content\ContentClient', array('sendRequest'));
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $category = $marketPartnerMock->getCategory(90402, array('geo_id' => 213));

        $this->assertEquals(
            $jsonObj->category->id,
            $category->getId()
        );
        $this->assertEquals(
            $jsonObj->category->name,
            $category->getName()
        );
        $this->assertEquals(
            $jsonObj->category->uniqName,
            $category->getUniqueName()
        );
        $this->assertEquals(
            $jsonObj->category->parentId,
            $category->getParentId()
        );
        $this->assertEquals(
            $jsonObj->category->childrenCount,
            $category->getChildrenCount()
        );
        $this->assertEquals(
            $jsonObj->category->offersNum,
            $category->getOffersCount()
        );
        $this->assertEquals(
            $jsonObj->category->modelsNum,
            $category->getModelsCount()
        );
        $this->assertEquals(
            $jsonObj->category->visual,
            $category->getIsVisual()
        );
        $this->assertEquals(
            $jsonObj->category->type,
            $category->getType()
        );
    }

    function testGetCategoryChildren()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/category-children.json');
        $jsonObj = json_decode($json);
        $response = new Response(200);
        $response->setBody($json);

        $marketPartnerMock = $this->getMock('Yandex\Market\Content\ContentClient', array('sendRequest'));
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $childrenCategories = $marketPartnerMock->getCategoryChildren(90402, array('geo_id' => 213, 'sort' => 'name'));

        $this->assertEquals(
            $jsonObj->categories->count,
            $childrenCategories->getCount()
        );

        $this->assertEquals(
            $jsonObj->categories->total,
            $childrenCategories->getTotal()
        );

        $this->assertEquals(
            $jsonObj->categories->page,
            $childrenCategories->getPage()
        );

        $items = $childrenCategories->getItems();

        /** @var Item $item0 */
        $item0 = $items->current();

        $this->assertEquals(
            $jsonObj->categories->items[0]->id,
            $item0->getId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->name,
            $item0->getName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->uniqName,
            $item0->getUniqueName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->parentId,
            $item0->getParentId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->childrenCount,
            $item0->getChildrenCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->offersNum,
            $item0->getOffersCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->modelsNum,
            $item0->getModelsCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->visual,
            $item0->getIsVisual()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->type,
            $item0->getType()
        );

        /** @var Item $item1 */
        $item1 = $items->next();

        $this->assertEquals(
            $jsonObj->categories->items[1]->id,
            $item1->getId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->name,
            $item1->getName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->uniqName,
            $item1->getUniqueName()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->parentId,
            $item1->getParentId()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->childrenCount,
            $item1->getChildrenCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->offersNum,
            $item1->getOffersCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->modelsNum,
            $item1->getModelsCount()
        );
        $this->assertEquals(
            $jsonObj->categories->items[1]->visual,
            $item1->getIsVisual()
        );
        $this->assertEquals(
            $jsonObj->categories->items[0]->type,
            $item1->getType()
        );
    }

    function testGetCategoryModels()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/category-models.json');
        $jsonObj = json_decode($json);
        $response = new Response(200);
        $response->setBody($json);

        $marketPartnerMock = $this->getMock('Yandex\Market\Content\ContentClient', array('sendRequest'));
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $categoryModels = $marketPartnerMock->getCategoryModels(7877999, array('geo_id' => 213, 'count' => 1));

        $models = $categoryModels->getItems();

        /** @var ProductModel $model0 */
        $model0 = $models->current();

        $this->assertEquals(
            $jsonObj->models->items[0]->id,
            $model0->getId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->name,
            $model0->getName()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->description,
            $model0->getDescription()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->categoryId,
            $model0->getCategoryId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->offersCount,
            $model0->getOffersCount()
        );

        // Prices
        $this->assertEquals(
            $jsonObj->models->items[0]->prices->max,
            $model0->getPrices()->getMax()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->prices->min,
            $model0->getPrices()->getMin()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->prices->curCode,
            $model0->getPrices()->getCurrencyCode()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->prices->curName,
            $model0->getPrices()->getCurrencyName()
        );

        // Filters
        $filters = $model0->getFilters();

        /** @var CategoryFilter $filter0 */
        $filter0 = $filters->current();

        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->id,
            $filter0->getId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->name,
            $filter0->getName()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->shortname,
            $filter0->getShortName()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->type,
            $filter0->getType()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->subType,
            $filter0->getSubType()
        );

        // Options
        $options = $filter0->getOptions();

        /** @var CategoryFilterOption $option0 */
        $option0 = $options->current();
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->options[0]->valueId,
            $option0->getValueId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->options[0]->valueText,
            $option0->getValueText()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->options[0]->tag,
            $option0->getTag()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->filters[0]->options[0]->code,
            $option0->getCode()
        );

        // Photos
        $photos = $model0->getPhotos();

        /** @var ProductModelPhoto $photo0 */
        $photo0 = $photos->current();

        $this->assertEquals(
            $jsonObj->models->items[0]->photos[0]->url,
            $photo0->getUrl()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[0]->width,
            $photo0->getWidth()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[0]->height,
            $photo0->getHeight()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[0]->offerId,
            $photo0->getOfferId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[0]->colorId,
            $photo0->getColorId()
        );

        /** @var ProductModelPhoto $photo1 */
        $photo1 = $photos->next();

        $this->assertEquals(
            $jsonObj->models->items[0]->photos[1]->url,
            $photo1->getUrl()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[1]->width,
            $photo1->getWidth()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[1]->height,
            $photo1->getHeight()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[1]->offerId,
            $photo1->getOfferId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->photos[1]->colorId,
            $photo1->getColorId()
        );

        // PreviewPhotos
        $previewPhotos = $model0->getPreviewPhotos();

        /** @var ProductModelPhoto $previewPhoto0 */
        $previewPhoto0 = $previewPhotos->current();

        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[0]->url,
            $previewPhoto0->getUrl()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[0]->width,
            $previewPhoto0->getWidth()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[0]->height,
            $previewPhoto0->getHeight()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[0]->offerId,
            $previewPhoto0->getOfferId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[0]->colorId,
            $previewPhoto0->getColorId()
        );

        /** @var ProductModelPhoto $previewPhoto1 */
        $previewPhoto1 = $previewPhotos->next();

        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[1]->url,
            $previewPhoto1->getUrl()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[1]->width,
            $previewPhoto1->getWidth()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[1]->height,
            $previewPhoto1->getHeight()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[1]->offerId,
            $previewPhoto1->getOfferId()
        );
        $this->assertEquals(
            $jsonObj->models->items[0]->previewPhotos[1]->colorId,
            $previewPhoto1->getColorId()
        );
    }

    function testGetCategoryFilters()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/category-filters.json');
        $jsonObj = json_decode($json);
        $response = new Response(200);
        $response->setBody($json);

        $marketPartnerMock = $this->getMock('Yandex\Market\Content\ContentClient', array('sendRequest'));
        $marketPartnerMock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $categoryFilters = $marketPartnerMock->getCategoryFilters(90598, array(
            'geo_id' => 213,
            'filter_set' => 'basic',
            'description' => 1
        ));

        $filters = $categoryFilters->getFilters();

        /** @var Filter $filter0 */
        $filter0 = $filters->current();
        $this->assertEquals(
            $jsonObj->filters[0]->id,
            $filter0->getId()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->name,
            $filter0->getName()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->shortname,
            $filter0->getShortName()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->type,
            $filter0->getType()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->unit,
            $filter0->getUnit()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->minValue,
            $filter0->getMinValue()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->maxValue,
            $filter0->getMaxValue()
        );

        // Property of filter
        if (isset($jsonObj->filters[0]->filterProperty)) {
            if (isset($jsonObj->filters[0]->filterProperty->longname)) {
                $this->assertEquals(
                    $jsonObj->filters[0]->filterProperty->longname,
                    $filter0->getProperty()->getLongName()
                );
            }
            if (isset($jsonObj->filters[0]->filterProperty->description)) {
                $this->assertEquals(
                    $jsonObj->filters[0]->filterProperty->description,
                    $filter0->getProperty()->getDescription()
                );
            }
        }

        // Options of filter
        //if (isset($jsonObj->filters[0]->options) && count($jsonObj->filters[0]->options) > 0) {
            $options = $filter0->getOptions();

            /** @var Option $option0 */
            $option0 = $options->current();

            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->valueId,
                $option0->getValueId()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->valueText,
                $option0->getValueText()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->count,
                $option0->getCount()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->popularity,
                $option0->getPopularity()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->tag,
                $option0->getTag()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->code,
                $option0->getCode()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->unit,
                $option0->getUnit()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[0]->unitName,
                $option0->getUnitName()
            );

            /** @var Option $option1 */
            $option1 = $options->next();

            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->valueId,
                $option1->getValueId()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->valueText,
                $option1->getValueText()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->count,
                $option1->getCount()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->popularity,
                $option1->getPopularity()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->tag,
                $option1->getTag()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->code,
                $option1->getCode()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->unit,
                $option1->getUnit()
            );
            $this->assertEquals(
                $jsonObj->filters[0]->options[1]->unitName,
                $option1->getUnitName()
            );
        //}

        /** @var Filter $filter1 */
        $filter1 = $filters->next();
        $this->assertEquals(
            $jsonObj->filters[1]->id,
            $filter1->getId()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->name,
            $filter1->getName()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->shortname,
            $filter1->getShortName()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->type,
            $filter1->getType()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->unit,
            $filter1->getUnit()
        );
        $this->assertEquals(
            $jsonObj->filters[0]->minValue,
            $filter0->getMinValue()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->maxValue,
            $filter1->getMaxValue()
        );

        // Property of filter
        if (isset($jsonObj->filters[1]->filterProperty)) {
            if (isset($jsonObj->filters[1]->filterProperty->longname)) {
                $this->assertEquals(
                    $jsonObj->filters[1]->filterProperty->longname,
                    $filter1->getProperty()->getLongName()
                );
            }
            if (isset($jsonObj->filters[1]->filterProperty->description)) {
                $this->assertEquals(
                    $jsonObj->filters[1]->filterProperty->description,
                    $filter1->getProperty()->getDescription()
                );
            }
        }

        // Options of filter
        //if (isset($jsonObj->filters[0]->options) && count($jsonObj->filters[0]->options) > 0) {
        $options = $filter1->getOptions();

        /** @var Option $option0 */
        $option0 = $options->current();

        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->valueId,
            $option0->getValueId()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->valueText,
            $option0->getValueText()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->count,
            $option0->getCount()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->popularity,
            $option0->getPopularity()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->tag,
            $option0->getTag()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->code,
            $option0->getCode()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->unit,
            $option0->getUnit()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[0]->unitName,
            $option0->getUnitName()
        );

        /** @var Option $option1 */
        $option1 = $options->next();

        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->valueId,
            $option1->getValueId()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->valueText,
            $option1->getValueText()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->count,
            $option1->getCount()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->popularity,
            $option1->getPopularity()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->tag,
            $option1->getTag()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->code,
            $option1->getCode()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->unit,
            $option1->getUnit()
        );
        $this->assertEquals(
            $jsonObj->filters[1]->options[1]->unitName,
            $option1->getUnitName()
        );
        //}
    }
}
