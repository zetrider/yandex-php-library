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
namespace Yandex\Dictionary;

use Yandex\Common\AbstractServiceClient;
use Yandex\Dictionary\DictionaryDefinition;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\RequestException;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Yandex\Dictionary\Exception\DictionaryException;

/**
 * Class DictionaryClient implements Yandex Dictionary protocol
 *
 * @category Yandex
 * @package  Dictionary
 *
 * @author   Nikolay Oleynikov <oleynikovny@mail.ru>
 * @created  07.11.14 18:43
 */
class DictionaryClient extends AbstractServiceClient
{

    /**
     * @const
     */
    const FAMILY_FLAG = 0x0001;

    /**
     * @const
     */
    const MORPHO_FLAG = 0x0004;

    /**
     * @const
     */
    const POSITION_FILTER_FLAG = 0x0008;

    /**
     * @var
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $serviceDomain = 'dictionary.yandex.net';

    /**
     * @var
     */
    protected $uiLanguage = 'en';

    /**
     * @var
     */
    protected $translateFrom = 'en';

    /**
     * @var
     */
    protected $translateTo = 'en';

    /**
     * @var
     */
    protected $flags = 0;

    /**
     * @param string $apiKey API key
     */
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param boolean $enabled optional boolean
     */
    public function setFamilyFlag($enabled = true)
    {
        $this->setFlag(self::FAMILY_FLAG,$enabled);

        return $this;
    }

    /**
     * @param boolean $enabled optional boolean
     */
    public function setMorphoFlag($enabled = true)
    {
        $this->setFlag(self::MORPHO_FLAG,$enabled);

        return $this;
    }

    /**
     * @param boolean $enabled optional boolean
     */
    public function setPositionFilterFlag($enabled = true)
    {
        $this->setFlag(self::POSITION_FILTER_FLAG,$enabled);

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param integer $flag
     * @param boolean $enabled optional boolean
     */
    public function setFlag($flag, $enabled = true)
    {
        if ($enabled){
            $this->flags |= $flag;
        }
        else{
            $this->flags &= ~$flag;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $uiLanguage
     */
    public function setUiLanguage($uiLanguage)
    {
        $this->uiLanguage = $uiLanguage;

        return $this;
    }

    /**
     * @return string
     */
    public function getUiLanguage()
    {
        return $this->uiLanguage;
    }

    /**
     * @param string $translateFrom
     */
    public function setTranslateFrom($translateFrom)
    {
        $this->translateFrom = $translateFrom;

        return $this;
    }

    /**
     * @return string
     */
    public function getTranslateFrom()
    {
        return $this->translateFrom;
    }

    /**
     * @param string $translateTo
     */
    public function setTranslateTo($translateTo)
    {
        $this->translateTo = $translateTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getTranslateTo()
    {
        return $this->translateTo;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->translateFrom . '-' . $this->translateTo;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function getLookupUrl($text)
    {
        $resource = 'api/v1/dicservice.json/lookup';
        $query = http_build_query(
            array(
                'key' => $this->getApiKey(),
                'lang' => $this->getLanguage(),
                'ui' => $this->getUiLanguage(),
                'flags' => $this->getFlags(),
                'text' => $text
            )
        );
        $url = $this->getServiceUrl($resource) . '?' . $query;

        return $url;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function getGetLanguagesUrl()
    {
        $resource = 'api/v1/dicservice.json/getLangs';
        $query = http_build_query(
            array(
                'key' => $this->getApiKey()
            )
        );
        $url = $this->getServiceUrl($resource) . '?' . $query;

        return $url;
    }

    /**
     * Looks up a text in the dictionary
     *
     * @param string $text
     *
     * @return
     */
    public function lookup($text)
    {
        $url = $this->getLookupUrl($text);
        $client = new Client();
        $request = $client->get($url);
        $response = $this->sendRequest($request);
        if ($response->getStatusCode() === 200) {
            $definitions = $this->parseLookupResponse($response);
            return $definitions;
        }
        return false;
    }

    /**
     * @return
     */
    public function getLanguages()
    {
        $url = $this->getGetLanguagesUrl();
        $client = new Client();
        $request = $client->get($url);
        $response = $this->sendRequest($request);
        if ($response->getStatusCode() === 200) {
            $languages = $this->parseGetLanguagesResponse($response);
            return $languages;
        }
        return false;
    }

    /**
     * @param Response $response
     */
    protected function parseLookupResponse(Response $response)
    {
        $responseData = $response->getBody(true);
        $responseObject = json_decode($responseData);
        $definitionsData = $responseObject->def;
        $definitions = array();
        foreach ($definitionsData as $definitionData){
            $definitions[] = new DictionaryDefinition($definitionData);
        }
        return $definitions;
    }

    /**
     * @param Response $response
     */
    protected function parseGetLanguagesResponse(Response $response)
    {
        $responseBody = $response->getBody(true);
        $responseData = json_decode($responseBody);
        $languages = array();
        foreach ($responseData as $language){
            $translation = explode('-',$language);
            $from = $translation[0];
            $to = $translation[1];
            $languages[] = array($from,$to);
        }
        return $languages;
    }

    /**
     * Sends a request
     *
     * @param RequestInterface $request
     * @return Response
     * @throws ForbiddenException
     */
    protected function sendRequest(RequestInterface $request)
    {
        try {
            $response = $request->send();

        } catch (ClientErrorResponseException $ex) {

            $result = $request->getResponse();
            $code = $result->getStatusCode();
            $message = $result->getReasonPhrase();

            if ($code === 403) {
                throw new ForbiddenException($message);
            }

            throw new DictionaryException(
                'Service responded with error code: "' . $code . '" and message: "' . $message . '"'
            );
        }

        return $response;
    }
}
