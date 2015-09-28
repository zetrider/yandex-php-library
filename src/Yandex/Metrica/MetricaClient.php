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
namespace Yandex\Metrica;

use Yandex\Common\AbstractServiceClient;
use Guzzle\Service\Client;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Yandex\Metrica\Exception\MetricaException;

/**
 * Class MetricaClient
 *
 * @category Yandex
 * @package Metrica
 *
 * @author   Alexander Khaylo <naxel@land.ru>
 * @created  12.02.14 15:46
 */
class MetricaClient extends AbstractServiceClient
{

    /**
     * API domain
     *
     * @var string
     */
    protected $serviceDomain = 'api-metrika.yandex.ru/management/v1';


    /**
     * @param string $token access token
     */
    public function __construct($token = '')
    {
        $this->setAccessToken($token);
    }


    /**
     * Get url to service resource with parameters
     *
     * @param string $resource
     * @param array $params
     * @see http://api.yandex.ru/metrika/doc/ref/concepts/method-call.xml
     * @return string
     */
    public function getServiceUrl($resource = '', $params = array())
    {
        $format = $resource === '' ? '' : '.json';
        $url = $this->serviceScheme . '://' . $this->serviceDomain . '/'
            . $resource . $format . '?oauth_token=' . $this->getAccessToken();

        if ($params) {
            $url .= '&' . http_build_query($params);
        }

        return $url;
    }


    /**
     * Sends a request
     *
     * @param RequestInterface $request
     * @return Response
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws MetricaException
     */
    protected function sendRequest(RequestInterface $request)
    {
        try {
            $request->setHeader('User-Agent', $this->getUserAgent());
            $response = $request->send();

        } catch (ClientErrorResponseException $ex) {

            $result = $request->getResponse();
            $code = $result->getStatusCode();
            $message = $result->getReasonPhrase();

            if ($code === 403) {
                throw new ForbiddenException($message);
            }

            if ($code === 401) {
                throw new UnauthorizedException($message);
            }

            throw new MetricaException(
                'Service responded with error code: "' . $code . '" and message: "' . $message . '"'
            );
        }

        return $response;
    }


    /**
     * Get OAuth data for header request
     *
     * @see http://api.yandex.ru/metrika/doc/ref/concepts/result-format.xml
     *
     * @return string
     */
    protected function getOauthData()
    {
        return 'OAuth ' . $this->getAccessToken();
    }


    /**
     * Send GET request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendGetRequest($resource, $params = array())
    {

        $client = new Client();
        $request = $client->get(
            $this->getServiceUrl($resource, $params),
            array(
                'Authorization' => $this->getOauthData(),
                'Accept' => 'application/x-yametrika+json',
                'Content-Type' => 'application/x-yametrika+json',
            )
        );
        $response = $this->sendRequest($request)->json();
        if (isset($response['links']) && isset($response['links']['next'])) {
            $url = $response['links']['next'];
            unset($response['rows']);
            unset($response['links']);
            $response = $this->getNextPartOfList($url, $response);
        }
        return $response;
    }


    /**
     * Send custom GET request to API resource
     *
     * @param string $url
     * @param array $data
     * @return array
     */
    protected function getNextPartOfList($url, $data = array())
    {
        $client = new Client();
        $request = $client->get(
            $url,
            array(
                'Authorization' => $this->getOauthData(),
                'Accept' => 'application/x-yametrika+json',
                'Content-Type' => 'application/x-yametrika+json',
            )
        );
        $response = $this->sendRequest($request)->json();

        $response = array_merge_recursive($data, $response);
        if (isset($response['links']) && isset($response['links']['next'])) {
            $url = $response['links'];
            unset($response['rows']);
            unset($response['links']);
            $response = $this->getNextPartOfList($url, $response);
        }

        return $response;
    }


    /**
     * Send POST request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendPostRequest($resource, $params)
    {
        $client = new Client();

        $request = $client->post(
            $this->getServiceUrl($resource),
            array(
                'Authorization' => $this->getOauthData(),
                'Accept' => 'application/x-yametrika+json',
                'Content-Type' => 'application/x-yametrika+json',
            ),
            json_encode($params)
        );

        $response = $this->sendRequest($request)->json();
        return $response;
    }


    /**
     * Send PUT request to API resource
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    protected function sendPutRequest($resource, $params)
    {
        $client = new Client();

        $request = $client->put(
            $this->getServiceUrl($resource),
            array(
                'Authorization' => $this->getOauthData(),
                'Accept' => 'application/x-yametrika+json',
                'Content-Type' => 'application/x-yametrika+json',
            ),
            json_encode($params)
        );

        $response = $this->sendRequest($request)->json();
        return $response;
    }


    /**
     * Send DELETE request to API resource
     *
     * @param string $resource
     * @return array
     */
    protected function sendDeleteRequest($resource)
    {
        $client = new Client();

        $request = $client->delete(
            $this->getServiceUrl($resource),
            array(
                'Authorization' => $this->getOauthData(),
                'Accept' => 'application/x-yametrika+json',
                'Content-Type' => 'application/x-yametrika+json',
            )
        );

        $response = $this->sendRequest($request)->json();
        return $response;
    }
}
