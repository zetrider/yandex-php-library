<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */

/**
 * @namespace
 */
namespace Yandex\Market\Content;

use Yandex\Common\AbstractServiceClient;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Yandex\Market\Content\Exception\ContentRequestException;
use Yandex\Market\Content\Models;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Guzzle\Service\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * Class ContentClient
 *
 * @category Yandex
 * @package MarketContent
 *
 * @author   Oleg Scherbakov <holdmann@yandex.ru>
 * @created  27.12.15 19:50
 */
class ContentClient extends AbstractServiceClient
{
    /**
     * Requested version of API
     *
     * @var string
     */
    private $version = 'v1';

    /**
     * API domain
     *
     * @var string
     */
    protected $serviceDomain = 'api.content.market.yandex.ru';

    /**
     * Store limits information during each API request
     *
     * @var array
     */
    private $limits = array();

    /**
     * Get url to service resource with parameters
     *
     * @param string $resource
     * @see http://api.yandex.ru/market/partner/doc/dg/concepts/method-call.xml
     * @return string
     */
    public function getServiceUrl($resource = '')
    {
        return $this->serviceScheme . '://' . $this->serviceDomain . '/'
        . $this->version . '/' . $resource;
    }

    /**
     * @param string $token access token
     */
    public function __construct($token = '')
    {
        $this->setAccessToken($token);
    }

    /**
     * Sends a request
     *
     * @param RequestInterface $request
     * @return Response
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ContentRequestException
     */
    protected function sendRequest(RequestInterface $request)
    {
        try {

            $request = $this->prepareRequest($request);
            $response = $request->send();

        } catch (ClientErrorResponseException $ex) {

            $response = $request->getResponse();
            $code = $response->getStatusCode();
            $message = $response->getReasonPhrase();

            $body = $response->getBody(true);

            if ($body) {
                $jsonBody = json_decode($body);
                if ($jsonBody && isset($jsonBody->error) && isset($jsonBody->error->message)) {
                    $message = $jsonBody->error->message;
                }
            }

            if ($code === 403) {
                throw new ForbiddenException($message);
            }

            if ($code === 401) {
                throw new UnauthorizedException($message);
            }

            throw new ContentRequestException(
                'Service responded with error code: "' . $code . '" and message: "' . $message . '"'
            );
        }
        // @note: Finally? php >= 5.5
        $this->setLimits($response->getHeaders());

        return $response;
    }

    private function setLimits($headers)
    {
        // const as header name?
        $limitHeaders = array(
            'X-RateLimit-Daily-Limit',
            'X-RateLimit-Daily-Remaining',
            'X-RateLimit-Global-Limit',
            'X-RateLimit-Global-Remaining',
            'X-RateLimit-Method-Limit',
            'X-RateLimit-Method-Remaining',
            'X-RateLimit-Until'
        );

        $this->limits = array();

        foreach($headers as $header) {
            if (in_array($header->getName(), $limitHeaders, true))
                $this->limits[$header->getName()] = (int) $header->__toString();

        }
    }

    /**
     * Get information about API limits
     *
     * @return array|false
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * Get information about specified API limit
     *
     * @return array|false
     */
    public function getLimit($name)
    {
        if (isset($this->limits[$name]))
            return $this->limits[$name];

        return false;
    }

    /**
     * prepareRequest
     *
     * @param \Guzzle\Http\Message\RequestInterface $request
     * @return RequestInterface
     */
    protected function prepareRequest(RequestInterface $request)
    {
        $request->setProtocolVersion($this->serviceProtocolVersion);

        $request->setHeader('Host', $this->getServiceDomain());
        $request->setHeader('Accept', '*/*');
        $request->setHeader('Authorization', $this->getAccessToken());

        return $request;
    }

    /**
     * Returns API service response.
     *
     * @param string $resource
     * @return array
     * @throws ContentRequestException
     * @throws ForbiddenException
     * @throws UnauthorizedException
     */
    protected function getServiceResponse($resource)
    {
        $client = new Client($this->getServiceUrl($resource));
        $request = $client->createRequest('GET');

        return $this->sendRequest($request)->json();
    }

    /**
     * Returns URL-encoded query string
     *
     * @note: similar to http_build_query(),
     * but transform key=>value where key == value to "?key" param.
     *
     * @param array|object $queryData
     * @param string $numericPrefix
     * @param string $argSeparator
     * @param int $encType
     *
     * @return string $queryString
     */
    protected function buildQueryString($queryData, $numericPrefix = '', $argSeparator = '&', $encType = PHP_QUERY_RFC3986)
    {
        foreach($queryData as $k=>&$v)
            if (!is_scalar($v))
                $v = implode(',', $v);

        $queryString = http_build_query($queryData, $numericPrefix, $argSeparator, $encType);

        foreach($queryData as $k=>$v)
            if ($k==$v)
                $queryString = str_replace("$k=$v", $v, $queryString);

        return $queryString;
    }
}