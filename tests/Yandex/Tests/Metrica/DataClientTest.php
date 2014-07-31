<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Stat\DataClient;
use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

class DataClientTest extends TestCase
{

    public function testGetTable()
    {
        $fixtures = Stat::$tableFixtures;

        $mock = $this->getMock('Yandex\Metrica\Stat\DataClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getTable(new Models\TableParams);

        $this->assertEquals($fixtures["query"]["id"], $table->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["dimensions"], $table->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $table->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $table->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["limit"], $table->getQuery()->getLimit());
        $this->assertEquals($fixtures["query"]["offset"], $table->getQuery()->getOffset());
        $this->assertEquals($fixtures["query"]["date1"], $table->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $table->getQuery()->getDate2());

        $this->assertEquals($fixtures["data"][0]["dimensions"], $table->getData()[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"], $table->getData()[0]->getMetrics());

        $this->assertEquals($fixtures["total_rows"], $table->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $table->getSampled());
        $this->assertEquals($fixtures["sample_share"], $table->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $table->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $table->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $table->getDataLag());
        $this->assertEquals($fixtures["totals"], $table->getTotals());
        $this->assertEquals($fixtures["min"], $table->getMin());
        $this->assertEquals($fixtures["max"], $table->getMax());
    }

    public function testGetDrillDown()
    {
        $fixtures = Stat::$drillDownFixtures;

        $mock = $this->getMock('Yandex\Metrica\Stat\DataClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getDrillDown(new Models\TableParams);

        $this->assertEquals($fixtures["query"]["id"], $table->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["preset"], $table->getQuery()->getPreset());
        $this->assertEquals($fixtures["query"]["dimensions"], $table->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $table->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $table->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["limit"], $table->getQuery()->getLimit());
        $this->assertEquals($fixtures["query"]["offset"], $table->getQuery()->getOffset());
        $this->assertEquals($fixtures["query"]["date1"], $table->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $table->getQuery()->getDate2());

        $this->assertEquals($fixtures["data"][0]["dimension"]["name"], $table->getData()[0]->getDimension()->getName());
        $this->assertEquals($fixtures["data"][0]["dimension"]["id"], $table->getData()[0]->getDimension()->getId());
        $this->assertEquals($fixtures["data"][0]["metrics"], $table->getData()[0]->getMetrics());
        $this->assertEquals($fixtures["data"][0]["expand"], $table->getData()[0]->getExpand());
        $this->assertEquals($fixtures["data"][1]["dimension"]["name"], $table->getData()[1]->getDimension()->getName());
        $this->assertEquals($fixtures["data"][1]["dimension"]["id"], $table->getData()[1]->getDimension()->getId());
        $this->assertEquals($fixtures["data"][1]["metrics"], $table->getData()[1]->getMetrics());
        $this->assertEquals($fixtures["data"][1]["expand"], $table->getData()[1]->getExpand());

        $this->assertEquals($fixtures["total_rows"], $table->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $table->getSampled());
        $this->assertEquals($fixtures["sample_share"], $table->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $table->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $table->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $table->getDataLag());
        $this->assertEquals($fixtures["totals"], $table->getTotals());
        $this->assertEquals($fixtures["min"], $table->getMin());
        $this->assertEquals($fixtures["max"], $table->getMax());
    }

    public function testGetByTime()
    {
        $fixtures = Stat::$byTimeFixtures;

        $mock = $this->getMock('Yandex\Metrica\Stat\DataClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getByTime(new Models\ByTimeParams());

        $this->assertEquals($fixtures["query"]["id"], $table->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["dimensions"], $table->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $table->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $table->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["date1"], $table->getQuery()->getDate1());
        $this->assertEquals($fixtures["query"]["date2"], $table->getQuery()->getDate2());

        $this->assertEquals($fixtures["data"][0]["dimensions"], $table->getData()[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"], $table->getData()[0]->getMetrics());

        $this->assertEquals($fixtures["total_rows"], $table->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $table->getSampled());
        $this->assertEquals($fixtures["sample_share"], $table->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $table->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $table->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $table->getDataLag());
        $this->assertEquals($fixtures["totals"], $table->getTotals());
    }

    public function testGetComparisonSegments()
    {
        $fixtures = Stat::$comparisonFixtures;

        $mock = $this->getMock('Yandex\Metrica\Stat\DataClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getComparisonSegments(new Models\ComparisonParams());

        $this->assertEquals($fixtures["query"]["id"], $table->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["dimensions"], $table->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $table->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $table->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["limit"], $table->getQuery()->getLimit());
        $this->assertEquals($fixtures["query"]["offset"], $table->getQuery()->getOffset());
        $this->assertEquals($fixtures["query"]["date1_a"], $table->getQuery()->getDate1A());
        $this->assertEquals($fixtures["query"]["date2_a"], $table->getQuery()->getDate2A());
        $this->assertEquals($fixtures["query"]["date1_b"], $table->getQuery()->getDate1B());
        $this->assertEquals($fixtures["query"]["date2_b"], $table->getQuery()->getDate2B());

        $this->assertEquals($fixtures["data"][0]["dimensions"], $table->getData()[0]->getDimensions());
        $this->assertEquals($fixtures["data"][0]["metrics"]["a"], $table->getData()[0]->getMetrics()->getA());
        $this->assertEquals($fixtures["data"][0]["metrics"]["b"], $table->getData()[0]->getMetrics()->getB());

        $this->assertEquals($fixtures["total_rows"], $table->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $table->getSampled());
        $this->assertEquals($fixtures["sample_share"], $table->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $table->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $table->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $table->getDataLag());
        $this->assertEquals($fixtures["totals"]["a"], $table->getTotals()->getA());
        $this->assertEquals($fixtures["totals"]["b"], $table->getTotals()->getB());
    }

    public function testGetComparisonDrillDown()
    {
        $fixtures = Stat::$drillDownComparisonFixtures;

        $mock = $this->getMock('Yandex\Metrica\Stat\DataClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getComparisonDrillDown(new Models\DrillDownComparisonParams());

        $this->assertEquals($fixtures["query"]["id"], $table->getQuery()->getId());
        $this->assertEquals($fixtures["query"]["preset"], $table->getQuery()->getPreset());
        $this->assertEquals($fixtures["query"]["dimensions"], $table->getQuery()->getDimensions());
        $this->assertEquals($fixtures["query"]["metrics"], $table->getQuery()->getMetrics());
        $this->assertEquals($fixtures["query"]["sort"], $table->getQuery()->getSort());
        $this->assertEquals($fixtures["query"]["limit"], $table->getQuery()->getLimit());
        $this->assertEquals($fixtures["query"]["offset"], $table->getQuery()->getOffset());
        $this->assertEquals($fixtures["query"]["date1_a"], $table->getQuery()->getDate1A());
        $this->assertEquals($fixtures["query"]["date2_a"], $table->getQuery()->getDate2A());
        $this->assertEquals($fixtures["query"]["date1_b"], $table->getQuery()->getDate1B());
        $this->assertEquals($fixtures["query"]["date2_b"], $table->getQuery()->getDate2B());

        $this->assertEquals($fixtures["data"][0]["dimension"]["name"], $table->getData()[0]->getDimension()->getName());
        $this->assertEquals($fixtures["data"][0]["dimension"]["id"], $table->getData()[0]->getDimension()->getId());
        $this->assertEquals($fixtures["data"][0]["metrics"]["a"], $table->getData()[0]->getMetrics()->getA());
        $this->assertEquals($fixtures["data"][0]["metrics"]["b"], $table->getData()[0]->getMetrics()->getB());
        $this->assertEquals($fixtures["data"][0]["expand"], $table->getData()[0]->getExpand());
        $this->assertEquals($fixtures["data"][1]["dimension"]["name"], $table->getData()[1]->getDimension()->getName());
        $this->assertEquals($fixtures["data"][1]["dimension"]["id"], $table->getData()[1]->getDimension()->getId());
        $this->assertEquals($fixtures["data"][1]["metrics"]["a"], $table->getData()[1]->getMetrics()->getA());
        $this->assertEquals($fixtures["data"][1]["metrics"]["b"], $table->getData()[1]->getMetrics()->getB());
        $this->assertEquals($fixtures["data"][1]["expand"], $table->getData()[1]->getExpand());

        $this->assertEquals($fixtures["total_rows"], $table->getTotalRows());
        $this->assertEquals($fixtures["sampled"], $table->getSampled());
        $this->assertEquals($fixtures["sample_share"], $table->getSampleShare());
        $this->assertEquals($fixtures["sample_size"], $table->getSampleSize());
        $this->assertEquals($fixtures["sample_space"], $table->getSampleSpace());
        $this->assertEquals($fixtures["data_lag"], $table->getDataLag());
        $this->assertEquals($fixtures["totals"]["a"], $table->getTotals()->getA());
        $this->assertEquals($fixtures["totals"]["b"], $table->getTotals()->getB());
    }
}
