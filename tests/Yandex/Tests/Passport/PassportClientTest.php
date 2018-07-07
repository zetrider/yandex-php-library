<?php


/**
 * @namespace
 */

namespace Yandex\Tests\Market\Partner;

use Yandex\Passport\PassportModel;
use Yandex\Tests\TestCase;

/**
 *
 * Class PassportClientTest
 * @package Yandex\Tests\Market\Partner
 */
class PassportClientTest extends TestCase
{
    protected $fixturesFolder = 'fixtures';

    function testBaseRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/base.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->id, $passport->getId());

        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());

        $this->assertEmpty($passport->getFirstName());
        $this->assertEmpty($passport->getLastName());
        $this->assertEmpty($passport->getDisplayName());
        $this->assertEmpty($passport->getDefaultEmail());
        $this->assertEmpty($passport->getRealName());
        $this->assertEmpty($passport->getisAvatarEmpty());
        $this->assertEmpty($passport->getBirthday());
        $this->assertEmpty($passport->getDefaultAvatarId());
        $this->assertEmpty($passport->getOldSocialLogin());
        $this->assertEmpty($passport->getSex());

    }

    function testFioSexRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/fio-sex.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->id, $passport->getId());
        $this->assertEquals($jsonObj->first_name, $passport->getFirstName());
        $this->assertEquals($jsonObj->last_name, $passport->getLastName());
        $this->assertEquals($jsonObj->sex, $passport->getSex());
        $this->assertEquals($jsonObj->display_name, $passport->getDisplayName());
        $this->assertEquals($jsonObj->real_name, $passport->getRealName());
        $this->assertEquals($jsonObj->old_social_login, $passport->getOldSocialLogin());

        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());

        $this->assertEmpty($passport->getDefaultEmail());
        $this->assertEmpty($passport->getisAvatarEmpty());
        $this->assertEmpty($passport->getBirthday());
        $this->assertEmpty($passport->getDefaultAvatarId());

    }

    function testEmailRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/email.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->id, $passport->getId());
        $this->assertEquals($jsonObj->default_email, $passport->getDefaultEmail());
        $this->assertEquals($jsonObj->old_social_login, $passport->getOldSocialLogin());

        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());
        $this->assertEquals($jsonObj->emails, $passport->getEmails()
                                                       ->asArray());

        $this->assertEmpty($passport->getFirstName());
        $this->assertEmpty($passport->getLastName());
        $this->assertEmpty($passport->getDisplayName());
        $this->assertEmpty($passport->getRealName());
        $this->assertEmpty($passport->getisAvatarEmpty());
        $this->assertEmpty($passport->getBirthday());
        $this->assertEmpty($passport->getDefaultAvatarId());
        $this->assertEmpty($passport->getSex());

    }

    function testBirthdayRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/birthday.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->id, $passport->getId());
        $this->assertEquals($jsonObj->birthday, $passport->getBirthday());
        $this->assertEquals($jsonObj->old_social_login, $passport->getOldSocialLogin());

        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());


        $this->assertEmpty($passport->getFirstName());
        $this->assertEmpty($passport->getLastName());
        $this->assertEmpty($passport->getDisplayName());
        $this->assertEmpty($passport->getDefaultEmail());
        $this->assertEmpty($passport->getRealName());
        $this->assertEmpty($passport->getisAvatarEmpty());
        $this->assertEmpty($passport->getDefaultAvatarId());
        $this->assertEmpty($passport->getSex());

    }

    function testAvatarRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/avatar.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->id, $passport->getId());
        $this->assertEquals($jsonObj->old_social_login, $passport->getOldSocialLogin());
        $this->assertEquals($jsonObj->is_avatar_empty, $passport->getisAvatarEmpty());
        $this->assertEquals($jsonObj->default_avatar_id, $passport->getDefaultAvatarId());
        $this->assertFalse($passport->getisAvatarEmpty());

        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());


        $this->assertEmpty($passport->getFirstName());
        $this->assertEmpty($passport->getLastName());
        $this->assertEmpty($passport->getDisplayName());
        $this->assertEmpty($passport->getDefaultEmail());
        $this->assertEmpty($passport->getRealName());
        $this->assertEmpty($passport->getBirthday());
        $this->assertEmpty($passport->getSex());

    }

    function testFullAccessRequest()
    {
        $json = file_get_contents(__DIR__ . '/' . $this->fixturesFolder . '/full-access.json');

        $passport = new PassportModel();
        $passport->fromJson($json);

        $jsonObj = json_decode($json);

        $this->assertEquals($jsonObj->first_name, $passport->getFirstName());
        $this->assertEquals($jsonObj->last_name, $passport->getLastName());
        $this->assertEquals($jsonObj->display_name, $passport->getDisplayName());
        $this->assertEquals($jsonObj->default_email, $passport->getDefaultEmail());
        $this->assertEquals($jsonObj->real_name, $passport->getRealName());
        $this->assertEquals($jsonObj->is_avatar_empty, $passport->getisAvatarEmpty());
        $this->assertEquals($jsonObj->birthday, $passport->getBirthday());
        $this->assertEquals($jsonObj->default_avatar_id, $passport->getDefaultAvatarId());
        $this->assertEquals($jsonObj->login, $passport->getLogin());
        $this->assertEquals($jsonObj->old_social_login, $passport->getOldSocialLogin());
        $this->assertEquals($jsonObj->sex, $passport->getSex());
        $this->assertEquals($jsonObj->id, $passport->getId());
        $this->assertEquals($jsonObj->openid_identities, $passport->getOpenidIdentities()
                                                                  ->asArray());
        $this->assertEquals($jsonObj->emails, $passport->getEmails()
                                                       ->asArray());
    }

}