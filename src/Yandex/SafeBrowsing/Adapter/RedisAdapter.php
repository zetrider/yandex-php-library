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
namespace Yandex\SafeBrowsing\Adapter;

use Predis\Client;

/**
 * Class RedisAdapter
 *
 * @category Yandex
 * @package SafeBrowsing
 */
class RedisAdapter
{
    const KEY_SHA_VARS = 'sha_vars';
    const KEY_SHA_VAR = 'sha_var';

    const KEY_HASH_PREFIXES = 'hash_prefixes';
    const KEY_HASH_PREFIX = 'hash_prefix';

    const KEY_CHUNK_NUMS = 'chunk_nums';
    const KEY_CHUNK_NUM = 'chunk_num';

    /**
     * @var Client
     */
    private $client;

    public function __construct($dsn = '', $options = [])
    {
        $this->client = $this->initClient($dsn, $options);
    }

    /**
     * @param string $dsn
     * @param array $options
     * @param bool $reset
     * @return Client
     */
    public function initClient($dsn = '', $options = [], $reset = false)
    {
        if (!$this->client || $reset) {
            $this->client = new Client($dsn, $options);
            $this->client->ping();
        }

        return $this->client;
    }

    /**
     * @param string $shaVar
     */
    public function addShaVar($shaVar)
    {
        $this->client->sadd(self::KEY_SHA_VARS, [$shaVar]);
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     */
    public function addChunkNum($shaVar, $chunkNum)
    {
        $this->client->sadd(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, self::KEY_CHUNK_NUMS), [$chunkNum]);
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     * @param string $hashPrefix
     */
    public function addHashPrefix($shaVar, $chunkNum, $hashPrefix)
    {
        $this->client->sadd(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, $chunkNum), [$hashPrefix]);
        $this->client->set(sprintf('%s:%s', self::KEY_HASH_PREFIX, $hashPrefix), json_encode([
            'sha_var' => $shaVar,
            'chunk_num' => $chunkNum,
        ]));
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     * @param string $hashPrefix
     */
    public function saveHashPrefix($shaVar, $chunkNum, $hashPrefix)
    {
        $this->addShaVar($shaVar);
        $this->addChunkNum($shaVar, $chunkNum);
        $this->addHashPrefix($shaVar, $chunkNum, $hashPrefix);
    }

    public function getShaVars()
    {
        return $this->client->smembers(self::KEY_SHA_VARS);
    }

    /**
     * @param string $shaVar
     * @return array
     */
    public function getChunkNums($shaVar)
    {
        return $this->client->smembers(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, self::KEY_CHUNK_NUMS));
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     * @return array
     */
    public function getHashPrefixes($shaVar, $chunkNum)
    {
        return $this->client->smembers(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, $chunkNum));
    }

    /**
     * @param string $hashPrefix
     * @return string|null
     */
    public function getHashPrefix($hashPrefix)
    {
        return $this->client->get(sprintf('%s:%s', self::KEY_HASH_PREFIX, $hashPrefix));
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     */
    public function removeChunkNum($shaVar, $chunkNum)
    {
        $this->client->srem(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, self::KEY_CHUNK_NUMS), $chunkNum);
        $this->client->del(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, $chunkNum));
        //todo: Remove sha_var if its last chunk_num removed
    }

    /**
     * @param string $shaVar
     * @param string $chunkNum
     * @param string $hashPrefix
     */
    public function removeHashPrefix($shaVar, $chunkNum, $hashPrefix)
    {
        $this->client->srem(sprintf('%s:%s:%s', self::KEY_SHA_VAR, $shaVar, $chunkNum), $hashPrefix);
        $this->client->del(sprintf('%s:%s', self::KEY_HASH_PREFIX, $hashPrefix));
        //todo: Remove chunk_num if its last hashPrefix removed
    }

    /**
     * @param array $hashes
     * @return bool
     */
    public function hasHashes($hashes)
    {
        if (!is_array($hashes)) {
            return false;
        }

        foreach ($hashes as $hash) {
            if (!empty($hash['prefix']) && $this->getHashPrefix($hash['prefix'])) {
                return true;
            }
        }

        return false;
    }
}
