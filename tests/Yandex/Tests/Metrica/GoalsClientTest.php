<?php

namespace Yandex\Tests\Metrica;

use Guzzle\Http\Message\Response;
use Yandex\Metrica\Management\GoalsClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Goals;

class GoalsClientTest extends TestCase
{
    public function testGetGoals()
    {
        $fixtures = Goals::$goalsFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\GoalsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getGoals(2215573);
        $conditions = $table[1]->getConditions();

        $this->assertEquals($fixtures["goals"][0]["id"], $table[0]->getId());
        $this->assertEquals($fixtures["goals"][0]["name"], $table[0]->getName());
        $this->assertEquals($fixtures["goals"][0]["type"], $table[0]->getType());
        $this->assertEquals($fixtures["goals"][0]["class"], $table[0]->getClass());
        $this->assertEquals($fixtures["goals"][1]["id"], $table[1]->getId());
        $this->assertEquals($fixtures["goals"][1]["name"], $table[1]->getName());
        $this->assertEquals($fixtures["goals"][1]["type"], $table[1]->getType());
        $this->assertEquals($fixtures["goals"][1]["flag"], $table[1]->getFlag());
        $this->assertEquals($fixtures["goals"][1]["class"], $table[1]->getClass());
        $this->assertEquals($fixtures["goals"][1]["conditions"][0]["type"], $conditions[0]->getType());
        $this->assertEquals($fixtures["goals"][1]["conditions"][0]["url"], $conditions[0]->getUrl());


    }

    public function testGetGoal()
    {
        $fixtures = Goals::$goalFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\GoalsClient', array('sendGetRequest'));
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getGoal(2215573, 334423);
        $conditions = $table->getConditions();

        $this->assertEquals($fixtures["goal"]["id"], $table->getId());
        $this->assertEquals($fixtures["goal"]["name"], $table->getName());
        $this->assertEquals($fixtures["goal"]["type"], $table->getType());
        $this->assertEquals($fixtures["goal"]["flag"], $table->getFlag());
        $this->assertEquals($fixtures["goal"]["class"], $table->getClass());
        $this->assertEquals($fixtures["goal"]["conditions"][0]["type"], $conditions[0]->getType());
        $this->assertEquals($fixtures["goal"]["conditions"][0]["url"], $conditions[0]->getUrl());
    }
}
