<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Management\DelegatesClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Delegates;

class DelegatesClientTest extends TestCase
{
    public function testGetDelegates()
    {
        $fixtures = Delegates::$delegatesFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\DelegatesClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getDelegates();

        $this->assertEquals($fixtures["delegates"][0]["user_login"], $table[0]->getUserLogin());
        $this->assertEquals($fixtures["delegates"][0]["created_at"], $table[0]->getCreatedAt());
        $this->assertEquals($fixtures["delegates"][0]["comment"], $table[0]->getComment());
    }
}
