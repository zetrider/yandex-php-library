<?php
/**
 * @namespace
 */
namespace Yandex\Pinger;

use Yandex\Common\AbstractPackage;
use Guzzle\Http\Client;
use Yandex\Pinger\Exception\InvalidIpException;
use Yandex\Pinger\Exception\InvalidSettingsException;
use Yandex\Pinger\Exception\InvalidUrlException;
use Yandex\Pinger\Exception\PingerException;

/**
 * Pinger
 *
 * @category Yandex
 * @package  Pinger
 *
 * @property string $key
 * @property string $login
 * @property string $searchId
 *
 * @author   Anton Shevchuk
 * @created  06.08.13 17:30
 */
class Pinger extends AbstractPackage
{
    /**
     * @var string
     */
    protected $host = "http://site.yandex.ru";

    /**
     * @var string
     */
    protected $path = "ping.xml";

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $searchId;

    /**
     * @var string
     */
    protected $pluginId;

    /**
     * @var string
     */
    protected $version;

    const ERROR_ILLEGAL_VALUE_TYPE = 'ILLEGAL_VALUE_TYPE';
    const ERROR_MALFORMED_URLS = 'MALFORMED_URLS';
    const ERROR_NO_SUCH_USER_IN_PASSPORT = 'NO_SUCH_USER_IN_PASSPORT';
    const ERROR_NOT_CONFIRMED_IN_WMC = 'NOT_CONFIRMED_IN_WMC';
    const ERROR_OUT_OF_SEARCH_AREA = 'OUT_OF_SEARCH_AREA';
    const ERROR_SEARCH_NOT_OWNED_BY_USER = 'SEARCH_NOT_OWNED_BY_USER';
    const ERROR_USER_NOT_PERMITTED = 'USER_NOT_PERMITTED';

    /**
     * ping
     *
     * @param $url
     * @param $timestamp
     * @throws Exception\PingerException
     * @return boolean
     */
    public function ping($url, $timestamp)
    {
        $this->checkOptions();

        $response = $this->doRequest($url, $timestamp);

        $xml = $response->xml();

        if (isset($xml->error) && isset($xml->error->code)) {
            $errorCode = (string) $xml->error->code;
            switch ($errorCode) {
                case self::ERROR_ILLEGAL_VALUE_TYPE:
                case self::ERROR_NO_SUCH_USER_IN_PASSPORT:
                case self::ERROR_SEARCH_NOT_OWNED_BY_USER:
                    throw new InvalidSettingsException();
                    break;
                case self::ERROR_USER_NOT_PERMITTED:
                    $errorParam = (string)$xml->error->param;
                    $errorValue = (string)$xml->error->value;

                    switch ($errorParam) {
                        case 'key':
                            throw new InvalidSettingsException(
                                "Wrong `key` value ($errorValue). Please check settings"
                            );
                            break;
                        case 'ip':
                            throw new InvalidIpException();
                            break;
                        default:
                            throw new InvalidSettingsException();
                            break;
                    }
                    break;
                default:
                    throw new PingerException("Unknown error. Please, contact our support team", $errorCode);
                    break;
            }
        } elseif (isset($xml->invalid)) {
            $errorCode = (string)$xml->invalid["reason"];
            switch ($errorCode) {
                case self::ERROR_NOT_CONFIRMED_IN_WMC:
                    throw new InvalidUrlException("Invalid site URL. Site is not confirmed on http://webmaster.yandex.ru/");
                    break;
                case self::ERROR_OUT_OF_SEARCH_AREA:
                    throw new InvalidUrlException("Invalid site URL. Site is not under your search area");
                    break;
                case self::ERROR_MALFORMED_URLS:
                    throw new InvalidUrlException("Invalid URL format");
                    break;
                default:
                    throw new PingerException("Unknown error. Please, contact our support team", $errorCode);
                    break;
            }
        } elseif (isset($xml->added) && isset($xml->added['count']) && $xml->added['count'] > 0) {
            return true;
        }
        return true;
    }


    /**
     * doCheckOptions
     *
     * @return boolean
     */
    protected function doCheckOptions()
    {
        return $this->key && $this->login && $this->searchId;
    }

    /**
     * @param $url
     * @param $timestamp
     * @return \Guzzle\Http\Message\Response
     */
    protected function doRequest($url, $timestamp)
    {
        $client = new Client($this->host);
        $client->setDefaultOption('headers', array('Y-SDK' => 'Pinger'));
        $client->setDefaultOption(
            'query',
            array(
                'key' => $this->key,
                'login' => $this->login,
                'search_id' => $this->searchId,
                'pluginid' => $this->pluginId,
                'cmsver' => $this->version
            )
        );

        /**
         * @var \Guzzle\Http\Message\EntityEnclosingRequest $request
         */
        $request = $client->post($this->path);
        $request->setPostField('urls', $url);
        $request->setPostField('publishdate', $timestamp);
        return $request->send();
    }
}
