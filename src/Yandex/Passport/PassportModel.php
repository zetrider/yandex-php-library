<?php

namespace Yandex\Passport;

use Yandex\Common\Model;

/**
 * Class PassportModel
 * @package  Yandex\Passport
 *
 * @author   mrG1K <mr@g1k.ru>
 * @see      https://tech.yandex.ru/passport/doc/dg/reference/response-docpage/
 */
class PassportModel extends Model
{
    /**
     * @var string|null
     */
    protected $first_name = null;
    /**
     * @var string|null
     */
    protected $last_name = null;
    /**
     * @var string|null
     */
    protected $display_name = null;
    /**
     * @var string|null
     */
    protected $default_email = null;
    /**
     * @var string|null
     */
    protected $real_name = null;
    /**
     * @var string|null
     */
    protected $is_avatar_empty = null;
    /**
     * @var boolean|null
     */
    protected $birthday = null;
    /**
     * @var string|null
     */
    protected $default_avatar_id = null;
    /**
     * @var string|null
     */
    protected $login = null;
    /**
     * @var string|null
     */
    protected $old_social_login = null;
    /**
     * @var string|null
     */
    protected $sex = null;
    /**
     * @var integer|null
     */
    protected $id = null;
    /**
     * @var \Yandex\Common\StringCollection|null
     */
    protected $emails = null;
    /**
     * @var \Yandex\Common\StringCollection|null
     */
    protected $openid_identities = null;

    /**
     * @var array
     */
    protected $mappingClasses = [
        'emails'            => 'Yandex\Common\StringCollection',
        'openid_identities' => 'Yandex\Common\StringCollection'
    ];

    /**
     * @return null|string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return null|string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return null|string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @return null|string
     */
    public function getDefaultEmail()
    {
        return $this->default_email;
    }

    /**
     * @return null|string
     */
    public function getRealName()
    {
        return $this->real_name;
    }

    /**
     * @return null|string
     */
    public function getisAvatarEmpty()
    {
        return $this->is_avatar_empty;
    }

    /**
     * @return bool|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return null|string
     */
    public function getDefaultAvatarId()
    {
        return $this->default_avatar_id;
    }

    /**
     * @return null|string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return null|string
     */
    public function getOldSocialLogin()
    {
        return $this->old_social_login;
    }

    /**
     * @return null|string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|\Yandex\Common\StringCollection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @return null|\Yandex\Common\StringCollection
     */
    public function getOpenidIdentities()
    {
        return $this->openid_identities;
    }
}
