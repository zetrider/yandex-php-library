<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Analytics\GaClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Analytics;
use Yandex\Metrica\Analytics\Models;

class GaClientTest extends TestCase
{

    public function testGetGaData()
    {
        $fixtures = Analytics::$analyticsFixtures;

        $mock = $this->getMock('Yandex\Metrica\Analytics\GaClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $response = $mock->getGaData(new Models\Params());

        $this->assertEquals($fixtures["kind"], $response->getKind());
        $this->assertEquals($fixtures["id"], $response->getId());
        $this->assertEquals($fixtures["selfLink"], $response->getSelfLink());
        $this->assertEquals($fixtures["containsSampledData"], $response->getContainsSampledData());
        $this->assertEquals($fixtures["sampleSize"], $response->getSampleSize());
        $this->assertEquals($fixtures["sampleSpace"], $response->getSampleSpace());

        $this->assertEquals($fixtures["itemsPerPage"], $response->getItemsPerPage());
        $this->assertEquals($fixtures["totalResults"], $response->getTotalResults());
        $this->assertEquals($fixtures["totalsForAllResults"], $response->getTotalsForAllResults());

        $this->assertEquals($fixtures["query"]["ids"], $response->getQuery()->getIds());
        $this->assertEquals($fixtures["query"]["dimensions"], $response->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $response->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $response->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["start-date"], $response->getQuery()->getStartDate());
        $this->assertEquals($fixtures["query"]["end-date"], $response->getQuery()->getEndDate());
        $this->assertEquals($fixtures["query"]["start-index"], $response->getQuery()->getStartIndex());
        $this->assertEquals($fixtures["query"]["max-results"], $response->getQuery()->getMaxResults());

        $columnHeaders = $response->getColumnHeaders();
        $this->assertEquals($fixtures["columnHeaders"][0]["name"], $columnHeaders[0]->getName());
        $this->assertEquals(
            $fixtures["columnHeaders"][0]["columnType"],
            $columnHeaders[0]->getColumnType()
        );
        $this->assertEquals(
            $fixtures["columnHeaders"][0]["dataType"],
            $columnHeaders[0]->getDataType()
        );
        $this->assertEquals(
            $fixtures["columnHeaders"][1]["name"],
            $columnHeaders[1]->getName()
        );
        $this->assertEquals(
            $fixtures["columnHeaders"][1]["columnType"],
            $columnHeaders[1]->getColumnType()
        );
        $this->assertEquals($fixtures["columnHeaders"][1]["dataType"], $columnHeaders[1]->getDataType());

        $this->assertEquals($fixtures["rows"], $response->getRows());
    }
}
