<?php
namespace Yandex\Tests\Metrica\Models\Stat;

use Guzzle\Http\Message\Response;
use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

class DrillDownComparisonItemsTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Stat::$drillDownFixtures;

        $dimension = new Models\Dimension();
        $dimension
            ->setId($fixtures["data"][0]["dimension"]["id"])
            ->setName($fixtures["data"][0]["dimension"]["name"]);

        $dimensions = new Models\Dimensions();
        $dimensions->add($dimension);

        $items = new Models\Items();
        $items
            ->setDimensions($dimensions)
            ->setMetrics($fixtures["data"][0]["metrics"]);

        $this->assertEquals($fixtures["data"][0]["dimension"]["name"], $items->getDimensions()->getAll()[0]->getName());
        $this->assertEquals($fixtures["data"][0]["dimension"]["id"], $items->getDimensions()->getAll()[0]->getId());
        $this->assertEquals($fixtures["data"][0]["metrics"], $items->getMetrics());
    }
}
 