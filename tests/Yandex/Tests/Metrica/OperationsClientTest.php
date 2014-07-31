<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Management\OperationsClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Operations;

class OperationsClientTest extends TestCase
{
    public function testGetOperations()
    {
        $fixtures = Operations::$operationsFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\OperationsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getOperations(2215573);

        $this->assertEquals($fixtures["operations"][0]["id"], $table[0]->getId());
        $this->assertEquals($fixtures["operations"][0]["action"], $table[0]->getAction());
        $this->assertEquals($fixtures["operations"][0]["attr"], $table[0]->getAttr());
        $this->assertEquals($fixtures["operations"][0]["value"], $table[0]->getValue());
        $this->assertEquals($fixtures["operations"][0]["status"], $table[0]->getStatus());
        $this->assertEquals($fixtures["operations"][1]["id"], $table[1]->getId());
        $this->assertEquals($fixtures["operations"][1]["action"], $table[1]->getAction());
        $this->assertEquals($fixtures["operations"][1]["attr"], $table[1]->getAttr());
        $this->assertEquals($fixtures["operations"][1]["value"], $table[1]->getValue());
        $this->assertEquals($fixtures["operations"][1]["status"], $table[1]->getStatus());
    }

    public function testGetOperation()
    {
        $fixtures = Operations::$operationFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\OperationsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getOperation(2215573, 66955);

        $this->assertEquals($fixtures["operation"]["id"], $table->getId());
        $this->assertEquals($fixtures["operation"]["action"], $table->getAction());
        $this->assertEquals($fixtures["operation"]["attr"], $table->getAttr());
        $this->assertEquals($fixtures["operation"]["value"], $table->getValue());
        $this->assertEquals($fixtures["operation"]["status"], $table->getStatus());
    }
}
