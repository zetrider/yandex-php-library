<?php
namespace Yandex\Tests\Metrica\Models\Stat;

use Guzzle\Http\Message\Response;
use Yandex\Tests\Metrica\Fixtures\Stat;
use Yandex\Tests\TestCase;
use Yandex\Metrica\Stat\Models;

class DataTest extends TestCase
{

    public function testGet()
    {
        $fixtures = Stat::$tableFixtures;

        $items = new Models\Items();
        $items
            ->setDimensions($fixtures['data'][0]['dimensions'])
            ->setMetrics($fixtures['data'][0]['metrics']);

        $data = new Models\Data();
        $data->add($items);

        $this->assertEquals($fixtures['data'][0]['dimensions'], $data->getAll()[0]->getDimensions());
        $this->assertEquals($fixtures['data'][0]['metrics'], $data->getAll()[0]->getMetrics());
    }
}
 