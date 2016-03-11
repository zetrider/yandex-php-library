<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link      https://github.com/nixsolutions/yandex-php-library
 */
/**
 * @namespace
 */
namespace Yandex\Tests\DataSync;

use GuzzleHttp\Psr7\Request;
use Yandex\DataSync\DataSyncClient;
use Yandex\DataSync\Models\Database;
use Yandex\Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;

/**
 * PackageTest
 *
 * @category Yandex
 * @package  Tests
 *
 * @author   Alex Khaylo
 * @created  04.03.16 11:51
 */
class DataSyncClientTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    function testConstruct()
    {
        $token          = 'TOKEN';
        $databaseId     = 'DATABASE_ID';
        $dataSyncClient = new DataSyncClient();
        $this->assertEmpty($dataSyncClient->getAccessToken());

        $dataSyncClient2 = new DataSyncClient($token, DataSyncClient::CONTEXT_USER, $databaseId);
        $this->assertEquals(DataSyncClient::CONTEXT_USER, $dataSyncClient2->getContext());
        $this->assertEquals($databaseId, $dataSyncClient2->getDatabaseId());
        $this->assertEquals($token, $dataSyncClient2->getAccessToken());
    }

    function testSetIncorrectContext()
    {
        $token   = 'TOKEN';
        $context = 'INCORRECT_CONTEXT';
        $this->setExpectedException('Yandex\Common\Exception\InvalidArgumentException');
        new DataSyncClient($token, $context);
    }

    function testGetEmptyDatabasesIdException()
    {
        $token          = 'TOKEN';
        $dataSyncClient = new DataSyncClient($token);
        $this->setExpectedException('Yandex\Common\Exception\InvalidArgumentException', 'Empty database id');
        $dataSyncClient->getDatabaseId();
    }

    function testGetEmptyContextException()
    {
        $token          = 'TOKEN';
        $dataSyncClient = new DataSyncClient($token);
        $this->setExpectedException('Yandex\Common\Exception\InvalidArgumentException', 'Empty context');
        $dataSyncClient->getContext();
    }

    function testSendRequestInvalidArgumentException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(400);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\InvalidArgumentException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestUnauthorizedException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(401);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\UnauthorizedException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestForbiddenException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(403);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\ForbiddenException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestNotFoundException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(404);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\NotFoundException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestIncorrectDataFormatException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(406);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\IncorrectDataFormatException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestRevisionOnServerOverCurrentException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(409);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\DataSync\Exception\RevisionOnServerOverCurrentException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestRevisionTooOldException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(410);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\DataSync\Exception\RevisionTooOldException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestIncorrectRevisionNumberException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(412);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\DataSync\Exception\IncorrectRevisionNumberException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestIncorrectDataFormatException2()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(415);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\IncorrectDataFormatException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestUnavailableResourceException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(423);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\UnavailableResourceException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestTooManyRequestsException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(429);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\Common\Exception\TooManyRequestsException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestMaxDatabasesCountException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(507);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\DataSync\Exception\MaxDatabasesCountException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequestDataSyncException()
    {
        $databaseId           = 'DATABASE_ID';
        $response             = new Response(599);
        $request              = new Request('GET', '');
        $exception            = new \GuzzleHttp\Exception\ClientException('error', $request, $response);
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->throwException($exception));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $this->setExpectedException('Yandex\DataSync\Exception\DataSyncException');
        $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
    }

    function testSendRequest()
    {
        $json                 = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/get-database.json');
        $response             = new Response(200, [], \GuzzleHttp\Psr7\stream_for($json));
        $databaseId           = 'DATABASE_ID';
        $guzzleHttpClientMock = $this->getMock('GuzzleHttp\Client', ['request']);
        $guzzleHttpClientMock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));
        /** @var DataSyncClient $dataSyncClientMock */
        $dataSyncClientMock = $this->getMock('Yandex\DataSync\DataSyncClient', ['getClient']);
        $dataSyncClientMock->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue($guzzleHttpClientMock));

        $database = $dataSyncClientMock->getDatabase($databaseId, DataSyncClient::CONTEXT_USER);
        $this->assertTrue($database instanceof Database);
    }
}
