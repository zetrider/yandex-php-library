<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Management\GrantsClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Grants;

class GrantsClientTest extends TestCase
{
    public function testGetGrants()
    {
        $fixtures = Grants::$grantsFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\GrantsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getGrants(2215573);

        $this->assertEquals($fixtures["grants"][0]["user_login"], $table[0]->getUserLogin());
        $this->assertEquals($fixtures["grants"][0]["perm"], $table[0]->getPerm());
        $this->assertEquals($fixtures["grants"][0]["created_at"], $table[0]->getCreatedAt());
        $this->assertEquals($fixtures["grants"][0]["comment"], $table[0]->getComment());
        $this->assertEquals($fixtures["grants"][1]["user_login"], $table[1]->getUserLogin());
        $this->assertEquals($fixtures["grants"][1]["perm"], $table[1]->getPerm());
        $this->assertEquals($fixtures["grants"][1]["created_at"], $table[1]->getCreatedAt());
        $this->assertEquals($fixtures["grants"][1]["comment"], $table[1]->getComment());
    }

    public function testGetGrant()
    {
        $fixtures = Grants::$grantFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\GrantsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getGrant(2215573, "api-metrika2");

        $this->assertEquals($fixtures["grant"]["user_login"], $table->getUserLogin());
        $this->assertEquals($fixtures["grant"]["perm"], $table->getPerm());
        $this->assertEquals($fixtures["grant"]["created_at"], $table->getCreatedAt());
        $this->assertEquals($fixtures["grant"]["comment"], $table->getComment());
    }
}
