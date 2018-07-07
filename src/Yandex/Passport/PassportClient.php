<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link      https://github.com/nixsolutions/yandex-php-library
 */

namespace Yandex\Passport;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Yandex\Common\AbstractServiceClient;
use Yandex\Common\Exception\UnauthorizedException;

/**
 * Class PassportClient
 *
 * @category Yandex
 * @package  Passport
 *
 * @author   mrG1K <mr@g1k.ru>
 * @see      https://tech.yandex.ru/passport/doc/dg/
 */
class PassportClient extends AbstractServiceClient
{

    public $serviceDomain = 'login.yandex.ru/info';

    /**
     * @param $token
     * @return \Yandex\Passport\PassportModel
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInfo($token)
    {

        $response = $this->sendRequest('GET', '?json', [
            'headers' => [
                'Authorization' => 'OAuth ' . $token
            ]
        ]);

        $decodedResponseBody = $this->getDecodedBody($response->getBody());

        return new PassportModel($decodedResponseBody);
    }


    /**
     * Sends a request
     *
     * @param string $method  HTTP method
     * @param string $uri     URI object or string.
     * @param array  $options Request options to apply.
     *
     * @return Response
     *
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendRequest($method, $uri, array $options = [])
    {
        try {
            $response = $this->getClient()
                             ->request($method, $uri, $options);
        } catch (ClientException $ex) {
            $result  = $ex->getResponse();
            $code    = $result->getStatusCode();
            $message = $result->getReasonPhrase();

            if ($code === 401) {
                throw new UnauthorizedException($message);
            }
        }

        return $response;
    }
}
