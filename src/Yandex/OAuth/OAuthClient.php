<?php

namespace Yandex\OAuth;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\RequestException;

/**
 * Class OAuthClient implements Yandex OAuth protocol
 *
 * @category Yandex
 * @package  OAuth
 *
 * @author   Eugene Zabolotniy <realbaziak@gmail.com>
 * @created  29.08.13 12:07
 */
class OAuthClient {

    /*
     * Authentication types constants
     *
     * Code type means that the server will use intermediate code to obtain access token.
     * Token type will result user is redirected to the server with access token in URL
     *
     */
    const CODE_AUTH_TYPE = 'code';
    const TOKEN_AUTH_TYPE = 'token';

    /**
     * @var string
     */
    private $clientId = '';

    /**
     * @var string
     */
    private $clientSecret = '';

    /**
     * @var string
     */
    protected $serviceScheme = 'https';

    /**
     * @var string
     */
    protected $serviceDomain = 'oauth.yandex.ru';

    /**
     * @var string
     */
    protected $servicePort = '';

    /**
     * @var string
     */
    protected $accessToken = '';

    public function __construct($clientId = '', $clientSecret = '')
    {
        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
    }

    /**
     * @param string $clientId
     *
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientSecret
     *
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $serviceDomain
     *
     * @return self
     */
    public function setServiceDomain($serviceDomain)
    {
        $this->serviceDomain = $serviceDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceDomain()
    {
        return $this->serviceDomain;
    }

    /**
     * @param string $servicePort
     *
     * @return self
     */
    public function setServicePort($servicePort)
    {
        $this->servicePort = $servicePort;

        return $this;
    }

    /**
     * @return string
     */
    public function getServicePort()
    {
        return $this->servicePort;
    }

    /**
     * @param string $serviceScheme
     *
     * @return self
     */
    public function setServiceScheme($serviceScheme)
    {
        $this->serviceScheme = $serviceScheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceScheme()
    {
        return $this->serviceScheme;
    }

    /**
     * @param string $resource
     * @return string
     */
    public function getServiceUrl($resource = '')
    {
        return $this->serviceScheme . '://' . $this->serviceDomain . '/' . rawurlencode($resource);
    }

    public function getAuthUrl($type = self::CODE_AUTH_TYPE)
    {
        return $this->getServiceUrl('authorize') . '?response_type=' . $type . '&client_id=' . $this->clientId;
    }

    /**
     * Sends redirect to Yandex authentication page.
     *
     * @param bool $exit    indicates whether to stop PHP script immediately or not
     * @param string $type  type of authentication procedure
     */
    public function authRedirect($exit = true, $type = self::CODE_AUTH_TYPE)
    {
        header('Location: ' . $this->getAuthUrl($type));

        if ($exit) {
            exit();
        }
    }

    /**
     * Exchanges temporary code to access token.
     *
     * @param $code
     *
     * @return self
     *
     * @throws AuthRequestException on known request error
     * @throws AuthResponseException on response format error
     * @throws RequestException on unknown request error
     */
    public function requestAccessToken($code)
    {
        $client = new Client($this->getServiceUrl());

        $request = $client->post('token', null, array(
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret
        ));

        try {

            $response = $request->send();

        } catch (ClientErrorResponseException $ex) {

            $result = $request->getResponse()->json();

            if (is_array($result) && isset($result['error'])) {
                // handle service error message
                throw new AuthRequestException('Service responsed with error code "' . $result['error'] . '"');
            }

            // unknown error
            throw $ex;
        }

        try {
            $result = $response->json();
        } catch (\RuntimeException $ex) {
            throw new AuthResponseException('Server response can\'t be parsed', 0, $ex);
        }

        if (!is_array($result)) {
            throw new AuthResponseException('Server response has unknown format');
        }

        if (!isset($result['access_token'])) {
            throw new AuthResponseException('Server response doesn\'t contain access token');
        }

        $this->setAccessToken($result['access_token']);

        return $this;

    }
}