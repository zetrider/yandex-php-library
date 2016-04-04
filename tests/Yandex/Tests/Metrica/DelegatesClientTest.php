<?php

namespace Yandex\Tests\Metrica;

use Yandex\Metrica\Management\DelegatesClient;
use Yandex\Tests\TestCase;
use Yandex\Tests\Metrica\Fixtures\Delegates;
use GuzzleHttp\Psr7\Response;
use Yandex\Metrica\Management\Models;

class DelegatesClientTest extends TestCase
{
    public function testGetDelegates()
    {
        $fixtures = Delegates::$delegatesFixtures;

        $mock = $this->getMock('Yandex\Metrica\Management\DelegatesClient', ['sendGetRequest']);
        $mock->expects($this->any())
            ->method('sendGetRequest')
            ->will($this->returnValue($fixtures));

        $table = $mock->getDelegates();

        $this->assertEquals($fixtures["delegates"][0]["user_login"], $table->current()->getUserLogin());
        $this->assertEquals($fixtures["delegates"][0]["created_at"], $table->current()->getCreatedAt());
        $this->assertEquals($fixtures["delegates"][0]["comment"], $table->current()->getComment());
    }

    public function testUpdateDelegates()
    {
        $fixtures             = Delegates::$delegatesFixtures;
        $token                = 'test';
        $response             = new Response(200, [], \GuzzleHttp\Psr7\stream_for(json_encode($fixtures)));
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        /** @var DelegatesClient $delegatesClientMock */
        $delegatesClientMock = $this->getMock('Yandex\Metrica\Management\DelegatesClient', ['getClient'], [$token]);
        $delegatesClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $delegates = new Models\Delegates($fixtures);
        $result    = $delegatesClientMock->updateDelegates($delegates);
        $this->assertTrue($result instanceof Models\Delegates);

        $this->assertEquals($fixtures["delegates"][0]["user_login"], $result->current()->getUserLogin());
        $this->assertEquals($fixtures["delegates"][0]["created_at"], $result->current()->getCreatedAt());
        $this->assertEquals($fixtures["delegates"][0]["comment"], $result->current()->getComment());
    }

    public function testAddDelegates()
    {
        $fixtures             = Delegates::$delegatesFixtures;
        $token                = 'test';
        $response             = new Response(200, [], \GuzzleHttp\Psr7\stream_for(json_encode($fixtures)));
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        /** @var DelegatesClient $delegatesClientMock */
        $delegatesClientMock = $this->getMock('Yandex\Metrica\Management\DelegatesClient', ['getClient'], [$token]);
        $delegatesClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $result = $delegatesClientMock->addDelegates('login', 'comment');
        $this->assertTrue($result instanceof Models\Delegates);

        $this->assertEquals($fixtures["delegates"][0]["user_login"], $result->current()->getUserLogin());
        $this->assertEquals($fixtures["delegates"][0]["created_at"], $result->current()->getCreatedAt());
        $this->assertEquals($fixtures["delegates"][0]["comment"], $result->current()->getComment());
    }

    public function testDeleteDelegate()
    {
        $fixtures             = Delegates::$delegateDeleteResponseFixtures;
        $token                = 'test';
        $response             = new Response(200, [], \GuzzleHttp\Psr7\stream_for(json_encode($fixtures)));
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        /** @var DelegatesClient $delegatesClientMock */
        $delegatesClientMock = $this->getMock('Yandex\Metrica\Management\DelegatesClient', ['getClient'], [$token]);
        $delegatesClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $result = $delegatesClientMock->deleteDelegate('login');
        $this->assertArrayHasKey('success', $result);
    }
}
