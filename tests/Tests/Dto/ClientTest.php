<?php
//
// Copyright (C) 2018 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\Client;
use Authlete\Dto\TaggedValue;
use Authlete\Types\ApplicationType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\ClientType;
use Authlete\Types\GrantType;
use Authlete\Types\JWEAlg;
use Authlete\Types\JWEEnc;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\SubjectType;


class ClientTest extends TestCase
{
    private const DEVELOPER                  = '_developer';
    private const CLIENT_ID_INT              = 1000;
    private const CLIENT_ID_STR              = '1001';
    private const CLIENT_ID_ALIAS            = '_client_id_alias_';
    private const CLIENT_SECRET              = '_client_secret_';
    private const CLIENT_NAME                = '_client_name_';
    private const LOGO_URI                   = '_logo_uri_';
    private const CLIENT_URI                 = '_client_uri_';
    private const POLICY_URI                 = '_policy_uri_';
    private const TOS_URI                    = '_tos_uri_';
    private const JWKS_URI                   = '_jwks_uri_';
    private const JWKS                       = '_jwks_';
    private const SECTOR_IDENTIFIER_URI      = '_sector_identifier_uri_';
    private const DEFAULT_MAX_AGE_INT        = 2000;
    private const DEFAULT_MAX_AGE_STR        = '2001';
    private const LOGIN_URI                  = '_login_uri_';
    private const DESCRIPTION                = '_description_';
    private const CREATED_AT_INT             = 3000;
    private const CREATED_AT_STR             = '3001';
    private const MODIFIED_AT_INT            = 4000;
    private const MODIFIED_AT_STR            = '4001';
    private const TLS_CLIENT_AUTH_SUBJECT_DN = '_tls_client_auth_subject_dn_';


    public function testDeveloperValidValue()
    {
        $obj = new Client();
        $obj->setDeveloper(self::DEVELOPER);

        $this->assertEquals(self::DEVELOPER, $obj->getDeveloper());
    }


    public function testDeveloperValidNull()
    {
        $obj = new Client();
        $obj->setDeveloper(null);

        $this->assertNull($obj->getDeveloper());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testDeveloperInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setDeveloper($invalid);
    }


    public function testClientIdValidInt()
    {
        $obj = new Client();
        $obj->setClientId(self::CLIENT_ID_INT);

        $this->assertEquals(self::CLIENT_ID_INT, $obj->getClientId());
    }


    public function testClientIdValidStr()
    {
        $obj = new Client();
        $obj->setClientId(self::CLIENT_ID_STR);

        $this->assertEquals(self::CLIENT_ID_STR, $obj->getClientId());
    }


    public function testClientIdValidNull()
    {
        $obj = new Client();
        $obj->setClientId(null);

        $this->assertNull($obj->getClientId());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientIdInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setClientId($invalid);
    }


    public function testClientIdAliasValidValue()
    {
        $obj = new Client();
        $obj->setClientIdAlias(self::CLIENT_ID_ALIAS);

        $this->assertEquals(self::CLIENT_ID_ALIAS, $obj->getClientIdAlias());
    }


    public function testClientIdAliasValidNull()
    {
        $obj = new Client();
        $obj->setClientIdAlias(null);

        $this->assertNull($obj->getClientIdAlias());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientIdAliasInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setClientIdAlias($invalid);
    }


    public function testClientIdAliasEnabledValidValue()
    {
        $obj = new Client();
        $obj->setClientIdAliasEnabled(true);

        $this->assertEquals(true, $obj->isClientIdAliasEnabled());
    }


    /** @expectedException InvalidArgumentException */
    public function testClientIdAliasEnabledInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setClientIdAliasEnabled($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testClientIdAliasEnabledInvalidNull()
    {
        $obj = new Client();
        $obj->setClientIdAliasEnabled(null);
    }


    public function testClientSecretValidValue()
    {
        $obj = new Client();
        $obj->setClientSecret(self::CLIENT_SECRET);

        $this->assertEquals(self::CLIENT_SECRET, $obj->getClientSecret());
    }


    public function testClientSecretValidNull()
    {
        $obj = new Client();
        $obj->setClientSecret(null);

        $this->assertNull($obj->getClientSecret());
    }


    /** @expectedException InvalidArgumentException */
    public function testClientSecretInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setClientSecret($invalid);
    }


    public function testClientTypeValidValue()
    {
        $obj = new Client();

        $type = ClientType::$PUBLIC;
        $obj->setClientType($type);

        $this->assertSame($type, $obj->getClientType());
    }


    public function testClientTypeValidNull()
    {
        $obj = new Client();
        $obj->setClientType(null);

        $this->assertNull($obj->getClientType());
    }


    /**
     * @expectedException Error
     */
    public function testClientTypeInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setClientType($invalid);
    }


    public function testRedirectUrisValidValue()
    {
        $obj = new Client();
        $obj->setRedirectUris(array('uri0', 'uri1'));

        $uris = $obj->getRedirectUris();

        $this->assertTrue(is_array($uris));
        $this->assertCount(2, $uris);
        $this->assertEquals('uri0', $uris[0]);
        $this->assertEquals('uri1', $uris[1]);
    }


    public function testRedirectUrisValidNull()
    {
        $obj = new Client();
        $obj->setRedirectUris(null);

        $this->assertNull($obj->getRedirectUris());
    }


    /**
     * @expectedException Error
     */
    public function testRedirectUrisInvalidString()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRedirectUris($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRedirectUrisInvalidArray()
    {
        $obj = new Client();

        $invalid = array(array(), array());
        $obj->setRedirectUris($invalid);
    }


    public function testResponseTypessValidValue()
    {
        $obj = new Client();

        $array = array(
            ResponseType::$CODE,
            ResponseType::$TOKEN
        );
        $obj->setResponseTypes($array);

        $types = $obj->getResponseTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertSame(ResponseType::$CODE,  $types[0]);
        $this->assertSame(ResponseType::$TOKEN, $types[1]);
    }


    public function testResponseTypesValidNull()
    {
        $obj = new Client();
        $obj->setResponseTypes(null);

        $this->assertNull($obj->getResponseTypes());
    }


    /**
     * @expectedException Error
     */
    public function testResponseTypesInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setResponseTypes($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testResponseTypesInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setResponseTypes($invalid);
    }


    public function testGrantTypessValidValue()
    {
        $obj = new Client();

        $array = array(
            GrantType::$AUTHORIZATION_CODE,
            GrantType::$IMPLICIT
        );
        $obj->setGrantTypes($array);

        $types = $obj->getGrantTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertSame(GrantType::$AUTHORIZATION_CODE,  $types[0]);
        $this->assertSame(GrantType::$IMPLICIT,            $types[1]);
    }


    public function testGrantTypesValidNull()
    {
        $obj = new Client();
        $obj->setGrantTypes(null);

        $this->assertNull($obj->getGrantTypes());
    }


    /**
     * @expectedException Error
     */
    public function testGrantTypesInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setGrantTypes($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testGrantTypesInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setGrantTypes($invalid);
    }


    public function testApplicationTypeValidValue()
    {
        $obj = new Client();

        $type = ApplicationType::$WEB;
        $obj->setApplicationType($type);

        $this->assertSame($type, $obj->getApplicationType());
    }


    public function testApplicationTypeValidNull()
    {
        $obj = new Client();
        $obj->setApplicationType(null);

        $this->assertNull($obj->getApplicationType());
    }


    public function testContactsValidValue()
    {
        $obj = new Client();
        $obj->setContacts(array('contact0', 'contact1'));

        $contacts = $obj->getContacts();

        $this->assertTrue(is_array($contacts));
        $this->assertCount(2, $contacts);
        $this->assertEquals('contact0', $contacts[0]);
        $this->assertEquals('contact1', $contacts[1]);
    }


    public function testContactsValidNull()
    {
        $obj = new Client();
        $obj->setContacts(null);

        $this->assertNull($obj->getContacts());
    }


    /**
     * @expectedException Error
     */
    public function testContactsInvalidString()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setContacts($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testContactsInvalidArray()
    {
        $obj = new Client();

        $invalid = array(array(), array());
        $obj->setContacts($invalid);
    }


    public function testClientNameValidValue()
    {
        $obj = new Client();
        $obj->setClientName(self::CLIENT_NAME);

        $this->assertEquals(self::CLIENT_NAME, $obj->getClientName());
    }


    public function testClientNameValidNull()
    {
        $obj = new Client();
        $obj->setClientName(null);

        $this->assertNull($obj->getClientName());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientNameInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setClientName($invalid);
    }


    public function testClientNamesValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setClientNames($array);

        $tags = $obj->getClientNames();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testClientNamesValidNull()
    {
        $obj = new Client();
        $obj->setClientNames(null);

        $this->assertNull($obj->getClientNames());
    }


    /**
     * @expectedException Error
     */
    public function testClientNamesInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setClientNames($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientNamesInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setClientNames($invalid);
    }


    public function testLogoUriValidValue()
    {
        $obj = new Client();
        $obj->setLogoUri(self::LOGO_URI);

        $this->assertEquals(self::LOGO_URI, $obj->getLogoUri());
    }


    public function testLogoUriValidNull()
    {
        $obj = new Client();
        $obj->setLogoUri(null);

        $this->assertNull($obj->getLogoUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testLogoUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setLogoUri($invalid);
    }


    public function testLogoUrisValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setLogoUris($array);

        $tags = $obj->getLogoUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testLogoUrisValidNull()
    {
        $obj = new Client();
        $obj->setLogoUris(null);

        $this->assertNull($obj->getLogoUris());
    }


    /**
     * @expectedException Error
     */
    public function testLogoUrisInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setLogoUris($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testLogoUrisInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setLogoUris($invalid);
    }


    public function testClientUriValidValue()
    {
        $obj = new Client();
        $obj->setClientUri(self::CLIENT_URI);

        $this->assertEquals(self::CLIENT_URI, $obj->getClientUri());
    }


    public function testClientUriValidNull()
    {
        $obj = new Client();
        $obj->setClientUri(null);

        $this->assertNull($obj->getClientUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setClientUri($invalid);
    }


    public function testClientUrisValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setClientUris($array);

        $tags = $obj->getClientUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testClientUrisValidNull()
    {
        $obj = new Client();
        $obj->setClientUris(null);

        $this->assertNull($obj->getClientUris());
    }


    /**
     * @expectedException Error
     */
    public function testClientUrisInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setClientUris($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClientUrisInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setClientUris($invalid);
    }


    public function testPolicyUriValidValue()
    {
        $obj = new Client();
        $obj->setPolicyUri(self::POLICY_URI);

        $this->assertEquals(self::POLICY_URI, $obj->getPolicyUri());
    }


    public function testPolicyUriValidNull()
    {
        $obj = new Client();
        $obj->setPolicyUri(null);

        $this->assertNull($obj->getPolicyUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testPolicyUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setPolicyUri($invalid);
    }


    public function testPolicyUrisValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setPolicyUris($array);

        $tags = $obj->getPolicyUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testPolicyUrisValidNull()
    {
        $obj = new Client();
        $obj->setPolicyUris(null);

        $this->assertNull($obj->getPolicyUris());
    }


    /**
     * @expectedException Error
     */
    public function testPolicyUrisInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setPolicyUris($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testPolicyUrisInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setPolicyUris($invalid);
    }


    public function testTosUriValidValue()
    {
        $obj = new Client();
        $obj->setTosUri(self::TOS_URI);

        $this->assertEquals(self::TOS_URI, $obj->getTosUri());
    }


    public function testTosUriValidNull()
    {
        $obj = new Client();
        $obj->setTosUri(null);

        $this->assertNull($obj->getTosUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTosUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setTosUri($invalid);
    }


    public function testTosUrisValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setTosUris($array);

        $tags = $obj->getTosUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testTosUrisValidNull()
    {
        $obj = new Client();
        $obj->setTosUris(null);

        $this->assertNull($obj->getTosUris());
    }


    /**
     * @expectedException Error
     */
    public function testTosUrisInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setTosUris($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTosUrisInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setTosUris($invalid);
    }


    public function testJwksUriValidValue()
    {
        $obj = new Client();
        $obj->setJwksUri(self::JWKS_URI);

        $this->assertEquals(self::JWKS_URI, $obj->getJwksUri());
    }


    public function testJwksUriValidNull()
    {
        $obj = new Client();
        $obj->setJwksUri(null);

        $this->assertNull($obj->getJwksUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testJwksUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setJwksUri($invalid);
    }


    public function testJwksValidValue()
    {
        $obj = new Client();
        $obj->setJwks(self::JWKS);

        $this->assertEquals(self::JWKS, $obj->getJwks());
    }


    public function testJwksValidNull()
    {
        $obj = new Client();
        $obj->setJwks(null);

        $this->assertNull($obj->getJwks());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testJwksInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setJwks($invalid);
    }


    public function testSectorIdentifierUriValidValue()
    {
        $obj = new Client();
        $obj->setSectorIdentifierUri(self::SECTOR_IDENTIFIER_URI);

        $this->assertEquals(self::SECTOR_IDENTIFIER_URI, $obj->getSectorIdentifierUri());
    }


    public function testSectorIdentifierUriValidNull()
    {
        $obj = new Client();
        $obj->setSectorIdentifierUri(null);

        $this->assertNull($obj->getSectorIdentifierUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSectorIdentifierUriInvalidValue()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setSectorIdentifierUri($invalid);
    }


    public function testSubjectTypeValidValue()
    {
        $obj = new Client();

        $type = SubjectType::$PUBLIC;
        $obj->setSubjectType($type);

        $this->assertSame($type, $obj->getSubjectType());
    }


    public function testSubjectTypeValidNull()
    {
        $obj = new Client();
        $obj->setSubjectType(null);

        $this->assertNull($obj->getSubjectType());
    }


    /**
     * @expectedException Error
     */
    public function testSubjectTypeInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setSubjectType($invalid);
    }


    public function testIdTokenSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::$HS256;
        $obj->setIdTokenSignAlg($alg);

        $this->assertSame($alg, $obj->getIdTokenSignAlg());
    }


    public function testIdTokenSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenSignAlg(null);

        $this->assertNull($obj->getIdTokenSignAlg());
    }


    /**
     * @expectedException Error
     */
    public function testIdTokenSignAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenSignAlg($invalid);
    }


    public function testIdTokenEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::$RSA1_5;
        $obj->setIdTokenEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getIdTokenEncryptionAlg());
    }


    public function testIdTokenEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenEncryptionAlg(null);

        $this->assertNull($obj->getIdTokenEncryptionAlg());
    }


    /**
     * @expectedException Error
     */
    public function testIdTokenEncryptionAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenEncryptionAlg($invalid);
    }


    public function testIdTokenEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::$A128CBC_HS256;
        $obj->setIdTokenEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getIdTokenEncryptionEnc());
    }


    public function testIdTokenEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenEncryptionEnc(null);

        $this->assertNull($obj->getIdTokenEncryptionEnc());
    }


    /**
     * @expectedException Error
     */
    public function testIdTokenEncryptionEncInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenEncryptionEnc($invalid);
    }


    public function testUserInfoSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::$RS256;
        $obj->setUserInfoSignAlg($alg);

        $this->assertSame($alg, $obj->getUserInfoSignAlg());
    }


    public function testUserInfoSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoSignAlg(null);

        $this->assertNull($obj->getUserInfoSignAlg());
    }


    /**
     * @expectedException Error
     */
    public function testUserInfoSignAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoSignAlg($invalid);
    }


    public function testUserInfoEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::$A128KW;
        $obj->setUserInfoEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getUserInfoEncryptionAlg());
    }


    public function testUserInfoEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoEncryptionAlg(null);

        $this->assertNull($obj->getUserInfoEncryptionAlg());
    }


    /**
     * @expectedException Error
     */
    public function testUserInfoEncryptionAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoEncryptionAlg($invalid);
    }


    public function testUserInfoEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::$A128GCM;
        $obj->setUserInfoEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getUserInfoEncryptionEnc());
    }


    public function testUserInfoEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoEncryptionEnc(null);

        $this->assertNull($obj->getUserInfoEncryptionEnc());
    }


    /**
     * @expectedException Error
     */
    public function testUserInfoEncryptionEncInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoEncryptionEnc($invalid);
    }


    public function testRequestSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::$ES256;
        $obj->setRequestSignAlg($alg);

        $this->assertSame($alg, $obj->getRequestSignAlg());
    }


    public function testRequestSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setRequestSignAlg(null);

        $this->assertNull($obj->getRequestSignAlg());
    }


    /**
     * @expectedException Error
     */
    public function testRequestSignAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestSignAlg($invalid);
    }


    public function testRequestEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::$ECDH_ES;
        $obj->setRequestEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getRequestEncryptionAlg());
    }


    public function testRequestEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setRequestEncryptionAlg(null);

        $this->assertNull($obj->getRequestEncryptionAlg());
    }


    /**
     * @expectedException Error
     */
    public function testRequestEncryptionAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestEncryptionAlg($invalid);
    }


    public function testRequestEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::$A192CBC_HS384;
        $obj->setRequestEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getRequestEncryptionEnc());
    }


    public function testRequestEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setRequestEncryptionEnc(null);

        $this->assertNull($obj->getRequestEncryptionEnc());
    }


    /**
     * @expectedException Error
     */
    public function testRequestEncryptionEncInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestEncryptionEnc($invalid);
    }


    public function testTokenAuthMethodValidValue()
    {
        $obj = new Client();

        $method = ClientAuthMethod::$CLIENT_SECRET_BASIC;
        $obj->setTokenAuthMethod($method);

        $this->assertSame($method, $obj->getTokenAuthMethod());
    }


    public function testTokenAuthMethodValidNull()
    {
        $obj = new Client();
        $obj->setTokenAuthMethod(null);

        $this->assertNull($obj->getTokenAuthMethod());
    }


    /**
     * @expectedException Error
     */
    public function testTokenAuthMethodInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setTokenAuthMethod($invalid);
    }


    public function testTokenAuthSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::$PS256;
        $obj->setTokenAuthSignAlg($alg);

        $this->assertSame($alg, $obj->getTokenAuthSignAlg());
    }


    public function testTokenAuthSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setTokenAuthSignAlg(null);

        $this->assertNull($obj->getTokenAuthSignAlg());
    }


    /**
     * @expectedException Error
     */
    public function testTokenAuthSignAlgInvalidValue()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setTokenAuthSignAlg($invalid);
    }


    public function testDefaultMaxAgeValidInt()
    {
        $obj = new Client();
        $obj->setDefaultMaxAge(self::DEFAULT_MAX_AGE_INT);

        $this->assertEquals(self::DEFAULT_MAX_AGE_INT, $obj->getDefaultMaxAge());
    }


    public function testDefaultMaxAgeValidStr()
    {
        $obj = new Client();
        $obj->setDefaultMaxAge(self::DEFAULT_MAX_AGE_STR);

        $this->assertEquals(self::DEFAULT_MAX_AGE_STR, $obj->getDefaultMaxAge());
    }


    public function testDefaultMaxAgeValidNull()
    {
        $obj = new Client();
        $obj->setDefaultMaxAge(null);

        $this->assertNull($obj->getDefaultMaxAge());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testDefaultMaxAgeInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setDefaultMaxAge($invalid);
    }


    public function testDescriptionValidValue()
    {
        $obj = new Client();
        $obj->setDescription(self::DESCRIPTION);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testDescriptionValidNull()
    {
        $obj = new Client();
        $obj->setDescription(null);

        $this->assertNull($obj->getDescription());
    }


    /** @expectedException InvalidArgumentException */
    public function testDescriptionInvalidValue()
    {
        $obj = new Client();

        $invalid = array();
        $obj->setDescription($invalid);
    }


    public function testDescriptionsValidValue()
    {
        $obj = new Client();

        $array = self::createArrayOfTaggedValue();
        $obj->setDescriptions($array);

        $tags = $obj->getDescriptions();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testDescriptionsValidNull()
    {
        $obj = new Client();
        $obj->setDescriptions(null);

        $this->assertNull($obj->getDescriptions());
    }


    /**
     * @expectedException Error
     */
    public function testDescriptionsInvalidType()
    {
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setDescriptions($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testDescriptionsInvalidElement()
    {
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setDescriptions($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = Client::fromJson($json);

        $this->assertInstanceof(Client::class, $obj);
    }


    public function testFromJsonDeveloperValidValue()
    {
        $json = '{"developer":"' . self::DEVELOPER . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::DEVELOPER, $obj->getDeveloper());
    }


    public function testFromJsonDeveloperValidNull()
    {
        $json = '{"developer":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getDeveloper());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDeveloperInvalidBool()
    {
        $json = '{"developer":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDeveloperInvalidNumber()
    {
        $json = '{"developer":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDevelopernvalidArray()
    {
        $json = '{"developer":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDeveloperInvalidObject()
    {
        $json = '{"developer":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasEnabledValidValue()
    {
        $json = '{"clientIdAliasEnabled":true}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidNull()
    {
        $json = '{"clientIdAliasEnabled":null}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidStringTrue()
    {
        $json = '{"clientIdAliasEnabled":"true"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidStringFalse()
    {
        $json = '{"clientIdAliasEnabled":"false"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledInvalidString()
    {
        $json = '{"clientIdAliasEnabled":"__INVALID__"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdAliasEnabledInvalidType()
    {
        $json = '{"clientIdAliasEnabled":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonClientTypeValidValue()
    {
        $json = '{"clientType":"PUBLIC"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(ClientType::$PUBLIC, $obj->getClientType());
    }


    public function testFromJsonClientTypeValidNull()
    {
        $json = '{"clientType":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getClientType());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientTypeInvalidBool()
    {
        $json = '{"clientType":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientTypeInvalidNumber()
    {
        $json = '{"clientType":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientTypeInvalidArray()
    {
        $json = '{"clientType":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientTypeInvalidObject()
    {
        $json = '{"clientType":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonRedirectUrisValidValue()
    {
        $json = '{"redirectUris":["uri0","uri1"]}';
        $obj  = Client::fromJson($json);

        $uris = $obj->getRedirectUris();

        $this->assertTrue(is_array($uris));
        $this->assertCount(2, $uris);
        $this->assertEquals('uri0', $uris[0]);
        $this->assertEquals('uri1', $uris[1]);
    }


    public function testFromJsonRedirectUrisValidNull()
    {
        $json = '{"redirectUris":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getRedirectUris());
    }


    /** @expectedException Error */
    public function testFromJsonRedirectUrisInvalidBool()
    {
        $json = '{"redirectUris":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonRedirectUrisInvalidNumber()
    {
        $json = '{"redirectUris":123}';
        $obj  = ClientExtension::fromJson($json);
    }


    public function testFromJsonResponseTypesValidValue()
    {
        $json = '{"responseTypes":["CODE","TOKEN"]}';
        $obj  = Client::fromJson($json);

        $types = $obj->getResponseTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertEquals(ResponseType::$CODE,  $types[0]);
        $this->assertEquals(ResponseType::$TOKEN, $types[1]);
    }


    public function testFromJsonResponseTypesValidNull()
    {
        $json = '{"responseTypes":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getResponseTypes());
    }


    /** @expectedException Error */
    public function testFromJsonResponseTypesInvalidBool()
    {
        $json = '{"responseTypes":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonResponseTypesInvalidNumber()
    {
        $json = '{"responseTypes":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonResponseTypesInvalidString()
    {
        $json = '{"responseTypes":"__INVALID__"}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseTypesInvalidElement()
    {
        $json = '{"responseTypes":["__INVALID__"]}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonGrantTypesValidValue()
    {
        $json = '{"grantTypes":["AUTHORIZATION_CODE","IMPLICIT"]}';
        $obj  = Client::fromJson($json);

        $types = $obj->getGrantTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertEquals(GrantType::$AUTHORIZATION_CODE, $types[0]);
        $this->assertEquals(GrantType::$IMPLICIT,           $types[1]);
    }


    public function testFromJsonGrantTypesValidNull()
    {
        $json = '{"grantTypes":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getGrantTypes());
    }


    /** @expectedException Error */
    public function testFromJsonGrantTypesInvalidBool()
    {
        $json = '{"grantTypes":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonGrantTypesInvalidNumber()
    {
        $json = '{"grantTypes":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonGrantTypesInvalidString()
    {
        $json = '{"grantTypes":"__INVALID__"}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonGrantTypesInvalidElement()
    {
        $json = '{"grantTypes":["__INVALID__"]}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonApplicationTypeValidValue()
    {
        $json = '{"applicationType":"WEB"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(ApplicationType::$WEB, $obj->getApplicationType());
    }


    public function testFromJsonApplicationTypeValidNull()
    {
        $json = '{"applicationType":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getApplicationType());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApplicationTypeInvalidBool()
    {
        $json = '{"applicationType":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApplicationTypeInvalidNumber()
    {
        $json = '{"applicationType":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApplicationTypeInvalidArray()
    {
        $json = '{"applicationType":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApplicationTypeInvalidObject()
    {
        $json = '{"applicationType":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonContactsValidValue()
    {
        $json = '{"contacts":["contact0","contact1"]}';
        $obj  = Client::fromJson($json);

        $contacts = $obj->getContacts();

        $this->assertTrue(is_array($contacts));
        $this->assertCount(2, $contacts);
        $this->assertEquals('contact0', $contacts[0]);
        $this->assertEquals('contact1', $contacts[1]);
    }


    public function testFromJsonContactsValidNull()
    {
        $json = '{"contacts":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getContacts());
    }


    /** @expectedException Error */
    public function testFromJsonContactsInvalidBool()
    {
        $json = '{"contacts":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonContactsInvalidNumber()
    {
        $json = '{"contacts":123}';
        $obj  = ClientExtension::fromJson($json);
    }


    public function testFromJsonClientNameValidValue()
    {
        $json = '{"clientName":"' . self::CLIENT_NAME . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::CLIENT_NAME, $obj->getClientName());
    }


    public function testFromJsonClientNameValidNull()
    {
        $json = '{"clientName":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getClientName());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientNameInvalidBool()
    {
        $json = '{"clientName":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientNameInvalidNumber()
    {
        $json = '{"clientName":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientNameInvalidArray()
    {
        $json = '{"clientName":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientNameInvalidObject()
    {
        $json = '{"clientName":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonClientNamesValidValue()
    {
        $json = '{"clientNames":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getClientNames();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonClientNamesValidNull()
    {
        $json = '{"clientNames":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getClientNames());
    }


    /** @expectedException Error */
    public function testFromJsonClientNamesInvalidBool()
    {
        $json = '{"clientNames":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientNamesInvalidNumber()
    {
        $json = '{"clientNames":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientNamesInvalidArray()
    {
        $json = '{"clientNames":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientNamesInvalidObject()
    {
        $json = '{"clientNames":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonLogoUriValidValue()
    {
        $json = '{"logoUri":"' . self::LOGO_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::LOGO_URI, $obj->getLogoUri());
    }


    public function testFromJsonLogoUriValidNull()
    {
        $json = '{"logoUri":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getLogoUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLogoUriInvalidBool()
    {
        $json = '{"logoUri":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLogoUriInvalidNumber()
    {
        $json = '{"logoUri":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLogoUriInvalidArray()
    {
        $json = '{"logoUri":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLogoUriInvalidObject()
    {
        $json = '{"logoUri":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonLogoUrisValidValue()
    {
        $json = '{"logoUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getLogoUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonLogoUrisValidNull()
    {
        $json = '{"logoUris":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getLogoUris());
    }


    /** @expectedException Error */
    public function testFromJsonLogoUrisInvalidBool()
    {
        $json = '{"logoUris":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonLogoUrisInvalidNumber()
    {
        $json = '{"logoUris":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonLogoUrisInvalidArray()
    {
        $json = '{"logoUris":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonLogoUrisInvalidObject()
    {
        $json = '{"logoUris":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonClientUriValidValue()
    {
        $json = '{"clientUri":"' . self::CLIENT_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::CLIENT_URI, $obj->getClientUri());
    }


    public function testFromJsonClientUriValidNull()
    {
        $json = '{"clientUri":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getClientUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientUriInvalidBool()
    {
        $json = '{"clientUri":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientUriInvalidNumber()
    {
        $json = '{"clientUri":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientUriInvalidArray()
    {
        $json = '{"clientUri":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientUriInvalidObject()
    {
        $json = '{"clientUri":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonClientUrisValidValue()
    {
        $json = '{"clientUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getClientUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonClientUrisValidNull()
    {
        $json = '{"clientUris":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getClientUris());
    }


    /** @expectedException Error */
    public function testFromJsonClientUrisInvalidBool()
    {
        $json = '{"clientUris":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientUrisInvalidNumber()
    {
        $json = '{"clientUris":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientUrisInvalidArray()
    {
        $json = '{"clientUris":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClientUrisInvalidObject()
    {
        $json = '{"clientUris":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonPolicyUriValidValue()
    {
        $json = '{"policyUri":"' . self::POLICY_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::POLICY_URI, $obj->getPolicyUri());
    }


    public function testFromJsonPolicyUriValidNull()
    {
        $json = '{"policyUri":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getPolicyUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPolicyUriInvalidBool()
    {
        $json = '{"policyUri":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPolicyUriInvalidNumber()
    {
        $json = '{"policyUri":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPolicyUriInvalidArray()
    {
        $json = '{"policyUri":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPolicyUriInvalidObject()
    {
        $json = '{"policyUri":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonPolicyUrisValidValue()
    {
        $json = '{"policyUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getPolicyUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonPolicyUrisValidNull()
    {
        $json = '{"policyUris":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getPolicyUris());
    }


    /** @expectedException Error */
    public function testFromJsonPolicyUrisInvalidBool()
    {
        $json = '{"policyUris":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPolicyUrisInvalidNumber()
    {
        $json = '{"policyUris":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPolicyUrisInvalidArray()
    {
        $json = '{"policyUris":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPolicyUrisInvalidObject()
    {
        $json = '{"policyUris":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonTosUriValidValue()
    {
        $json = '{"tosUri":"' . self::TOS_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::TOS_URI, $obj->getTosUri());
    }


    public function testFromJsonTosUriValidNull()
    {
        $json = '{"tosUri":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getTosUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTosUriInvalidBool()
    {
        $json = '{"tosUri":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTosUriInvalidNumber()
    {
        $json = '{"tosUri":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTosUriInvalidArray()
    {
        $json = '{"tosUri":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTosUriInvalidObject()
    {
        $json = '{"tosUri":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonTosUrisValidValue()
    {
        $json = '{"tosUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getTosUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonTosUrisValidNull()
    {
        $json = '{"tosUris":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getTosUris());
    }


    /** @expectedException Error */
    public function testFromJsonTosUrisInvalidBool()
    {
        $json = '{"tosUris":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonTosUrisInvalidNumber()
    {
        $json = '{"tosUris":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonTosUrisInvalidArray()
    {
        $json = '{"tosUris":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonTosUrisInvalidObject()
    {
        $json = '{"tosUris":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonJwksUriValidValue()
    {
        $json = '{"jwksUri":"' . self::JWKS_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::JWKS_URI, $obj->getJwksUri());
    }


    public function testFromJsonJwksUriValidNull()
    {
        $json = '{"jwksUri":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getJwksUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidBool()
    {
        $json = '{"jwksUri":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidNumber()
    {
        $json = '{"jwksUri":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidArray()
    {
        $json = '{"jwksUri":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidObject()
    {
        $json = '{"jwksUri":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonJwksValidValue()
    {
        $json = '{"jwks":"' . self::JWKS . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::JWKS, $obj->getJwks());
    }


    public function testFromJsonJwksValidNull()
    {
        $json = '{"jwks":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getJwks());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidBool()
    {
        $json = '{"jwks":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidNumber()
    {
        $json = '{"jwks":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidArray()
    {
        $json = '{"jwks":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidObject()
    {
        $json = '{"jwks":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonSectorIdentifierUriValidValue()
    {
        $json = '{"sectorIdentifier":"' . self::SECTOR_IDENTIFIER_URI . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::SECTOR_IDENTIFIER_URI, $obj->getSectorIdentifierUri());
    }


    public function testFromJsonSectorIdentifierUriValidNull()
    {
        $json = '{"sectorIdentifier":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getSectorIdentifierUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSectorIdentifierUriInvalidBool()
    {
        $json = '{"sectorIdentifier":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSectorIdentifierUriInvalidNumber()
    {
        $json = '{"sectorIdentifier":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSectorIdentifierUriInvalidArray()
    {
        $json = '{"sectorIdentifier":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSectorIdentifierUriInvalidObject()
    {
        $json = '{"sectorIdentifier":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonSubjectTypeValidValue()
    {
        $json = '{"subjectType":"PUBLIC"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(SubjectType::$PUBLIC, $obj->getSubjectType());
    }


    public function testFromJsonSubjectTypeValidNull()
    {
        $json = '{"subjectType":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getSubjectType());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectTypeInvalidBool()
    {
        $json = '{"subjectType":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectTypeInvalidNumber()
    {
        $json = '{"subjectType":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectTypeInvalidArray()
    {
        $json = '{"subjectType":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectTypeInvalidObject()
    {
        $json = '{"subjectType":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonIdTokenSignAlgValidValue()
    {
        $json = '{"idTokenSignAlg":"HS256"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWSAlg::$HS256, $obj->getIdTokenSignAlg());
    }


    public function testFromJsonIdTokenSignAlgValidNull()
    {
        $json = '{"idTokenSignAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenSignAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenSignAlgInvalidBool()
    {
        $json = '{"idTokenSignAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenSignAlgInvalidNumber()
    {
        $json = '{"idTokenSignAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenSignAlgInvalidArray()
    {
        $json = '{"idTokenSignAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenSignAlgInvalidObject()
    {
        $json = '{"idTokenSignAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionAlgValidValue()
    {
        $json = '{"idTokenEncryptionAlg":"RSA1_5"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEAlg::$RSA1_5, $obj->getIdTokenEncryptionAlg());
    }


    public function testFromJsonIdTokenEncryptionAlgValidNull()
    {
        $json = '{"idTokenEncryptionAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenEncryptionAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionAlgInvalidBool()
    {
        $json = '{"idTokenEncryptionAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionAlgInvalidNumber()
    {
        $json = '{"idTokenEncryptionAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionAlgInvalidArray()
    {
        $json = '{"idTokenEncryptionAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionAlgInvalidObject()
    {
        $json = '{"idTokenEncryptionAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionEncValidValue()
    {
        $json = '{"idTokenEncryptionEnc":"A128CBC_HS256"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEEnc::$A128CBC_HS256, $obj->getIdTokenEncryptionEnc());
    }


    public function testFromJsonIdTokenEncryptionEncValidNull()
    {
        $json = '{"idTokenEncryptionEnc":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenEncryptionEnc());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionEncInvalidBool()
    {
        $json = '{"idTokenEncryptionEnc":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionEncInvalidNumber()
    {
        $json = '{"idTokenEncryptionEnc":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionEncInvalidArray()
    {
        $json = '{"idTokenEncryptionEnc":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIdTokenEncryptionEncInvalidObject()
    {
        $json = '{"idTokenEncryptionEnc":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonUserInfoSignAlgValidValue()
    {
        $json = '{"userInfoSignAlg":"RS256"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWSAlg::$RS256, $obj->getUserInfoSignAlg());
    }


    public function testFromJsonUserInfoSignAlgValidNull()
    {
        $json = '{"userInfoSignAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoSignAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoSignAlgInvalidBool()
    {
        $json = '{"userInfoSignAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoSignAlgInvalidNumber()
    {
        $json = '{"userInfoSignAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoSignAlgInvalidArray()
    {
        $json = '{"userInfoSignAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoSignAlgInvalidObject()
    {
        $json = '{"userInfoSignAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionAlgValidValue()
    {
        $json = '{"userInfoEncryptionAlg":"A128KW"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEAlg::$A128KW, $obj->getUserInfoEncryptionAlg());
    }


    public function testFromJsonUserInfoEncryptionAlgValidNull()
    {
        $json = '{"userInfoEncryptionAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoEncryptionAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionAlgInvalidBool()
    {
        $json = '{"userInfoEncryptionAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionAlgInvalidNumber()
    {
        $json = '{"userInfoEncryptionAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionAlgInvalidArray()
    {
        $json = '{"userInfoEncryptionAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionAlgInvalidObject()
    {
        $json = '{"userInfoEncryptionAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionEncValidValue()
    {
        $json = '{"userInfoEncryptionEnc":"A128GCM"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEEnc::$A128GCM, $obj->getUserInfoEncryptionEnc());
    }


    public function testFromJsonUserInfoEncryptionEncValidNull()
    {
        $json = '{"userInfoEncryptionEnc":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoEncryptionEnc());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionEncInvalidBool()
    {
        $json = '{"userInfoEncryptionEnc":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionEncInvalidNumber()
    {
        $json = '{"userInfoEncryptionEnc":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionEncInvalidArray()
    {
        $json = '{"userInfoEncryptionEnc":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEncryptionEncInvalidObject()
    {
        $json = '{"userInfoEncryptionEnc":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonRequestSignAlgValidValue()
    {
        $json = '{"requestSignAlg":"ES256"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWSAlg::$ES256, $obj->getRequestSignAlg());
    }


    public function testFromJsonRequestSignAlgValidNull()
    {
        $json = '{"requestSignAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getRequestSignAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestSignAlgInvalidBool()
    {
        $json = '{"requestSignAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestSignAlgInvalidNumber()
    {
        $json = '{"requestSignAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestSignAlgInvalidArray()
    {
        $json = '{"requestSignAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestSignAlgInvalidObject()
    {
        $json = '{"requestSignAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionAlgValidValue()
    {
        $json = '{"requestEncryptionAlg":"ECDH_ES"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEAlg::$ECDH_ES, $obj->getRequestEncryptionAlg());
    }


    public function testFromJsonRequestEncryptionAlgValidNull()
    {
        $json = '{"requestEncryptionAlg":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getRequestEncryptionAlg());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionAlgInvalidBool()
    {
        $json = '{"requestEncryptionAlg":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionAlgInvalidNumber()
    {
        $json = '{"requestEncryptionAlg":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionAlgInvalidArray()
    {
        $json = '{"requestEncryptionAlg":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionAlgInvalidObject()
    {
        $json = '{"requestEncryptionAlg":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionEncValidValue()
    {
        $json = '{"requestEncryptionEnc":"A256GCM"}';
        $obj  = Client::fromJson($json);

        $this->assertSame(JWEEnc::$A256GCM, $obj->getRequestEncryptionEnc());
    }


    public function testFromJsonRequestEncryptionEncValidNull()
    {
        $json = '{"requestEncryptionEnc":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getRequestEncryptionEnc());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionEncInvalidBool()
    {
        $json = '{"requestEncryptionEnc":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionEncInvalidNumber()
    {
        $json = '{"requestEncryptionEnc":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionEncInvalidArray()
    {
        $json = '{"requestEncryptionEnc":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRequestEncryptionEncInvalidObject()
    {
        $json = '{"requestEncryptionEnc":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonDescriptionValidValue()
    {
        $json = '{"description":"' . self::DESCRIPTION . '"}';
        $obj  = Client::fromJson($json);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testFromJsonDescriptionValidNull()
    {
        $json = '{"description":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getDescription());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidBool()
    {
        $json = '{"description":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidNumber()
    {
        $json = '{"description":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidArray()
    {
        $json = '{"description":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDescriptionInvalidObject()
    {
        $json = '{"description":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testFromJsonDescriptionsValidValue()
    {
        $json = '{"descriptions":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj  = Client::fromJson($json);

        $tags = $obj->getDescriptions();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonDescriptionsValidNull()
    {
        $json = '{"descriptions":null}';
        $obj  = Client::fromJson($json);

        $this->assertNull($obj->getDescriptions());
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidBool()
    {
        $json = '{"descriptions":true}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidNumber()
    {
        $json = '{"descriptions":123}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidArray()
    {
        $json = '{"descriptions":["a","b"]}';
        $obj  = Client::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonDescriptionsInvalidObject()
    {
        $json = '{"descriptions":{"a":"b"}}';
        $obj  = Client::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new Client();
        $obj->setDeveloper(self::DEVELOPER)
            ->setClientId(self::CLIENT_ID_INT)
            ->setClientIdAlias(self::CLIENT_ID_ALIAS)
            ->setClientIdAliasEnabled(true)
            ->setClientSecret(self::CLIENT_SECRET)
            ->setClientType(ClientType::$PUBLIC)
            ->setRedirectUris(
                array(
                    "redirect_uri-0",
                    "redirect_uri-1"
                )
            )
            ->setResponseTypes(
                array(
                    ResponseType::$CODE,
                    ResponseType::$TOKEN
                )
            )
            ->setGrantTypes(
                array(
                    GrantType::$AUTHORIZATION_CODE,
                    GrantType::$IMPLICIT
                )
            )
            ->setApplicationType(ApplicationType::$WEB)
            ->setContacts(
                array(
                    "contact-0",
                    "contact-1"
                )
            )
            ->setClientName(self::CLIENT_NAME)
            ->setClientNames(
                array(
                    new TaggedValue('client-name-tag-0', 'client-name-value-0'),
                    new TaggedValue('client-name-tag-1', 'client-name-value-1')
                )
            )
            ->setLogoUri(self::LOGO_URI)
            ->setLogoUris(
                array(
                    new TaggedValue('logo-uri-tag-0', 'logo-uri-value-0'),
                    new TaggedValue('logo-uri-tag-1', 'logo-uri-value-1')
                )
            )
            ->setDescription(self::DESCRIPTION)
            ->setDescriptions(
                array(
                    new TaggedValue('description-tag-0', 'description-value-0'),
                    new TaggedValue('description-tag-1', 'description-value-1')
                )
            )
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // developer
        $this->assertArrayHasKey('developer', $array);
        $this->assertEquals(self::DEVELOPER, $array['developer']);

        // clientId
        $this->assertArrayHasKey('clientId', $array);
        $this->assertEquals(self::CLIENT_ID_INT, $array['clientId']);

        // clientIdAlias
        $this->assertArrayHasKey('clientIdAlias', $array);
        $this->assertEquals(self::CLIENT_ID_ALIAS, $array['clientIdAlias']);

        // clientIdAliasEnabled
        $this->assertArrayHasKey('clientIdAliasEnabled', $array);
        $this->assertEquals(true, $array['clientIdAliasEnabled']);

        // clientSecret
        $this->assertArrayHasKey('clientSecret', $array);
        $this->assertEquals(self::CLIENT_SECRET, $array['clientSecret']);

        // clientType
        $this->assertArrayHasKey('clientType', $array);
        $this->assertEquals('PUBLIC', $array['clientType']);

        // redirectUris
        $this->assertArrayHasKey('redirectUris', $array);
        $redirectUris = $array['redirectUris'];

        $this->assertTrue(is_array($redirectUris));
        $this->assertCount(2, $redirectUris);
        $this->assertEquals("redirect_uri-0", $redirectUris[0]);
        $this->assertEquals("redirect_uri-1", $redirectUris[1]);

        // responseTypes
        $this->assertArrayHasKey('responseTypes', $array);
        $responseTypes = $array['responseTypes'];

        $this->assertTrue(is_array($responseTypes));
        $this->assertCount(2, $responseTypes);
        $this->assertEquals('CODE',  $responseTypes[0]);
        $this->assertEquals('TOKEN', $responseTypes[1]);

        // grantTypes
        $this->assertArrayHasKey('grantTypes', $array);
        $grantTypes = $array['grantTypes'];

        $this->assertTrue(is_array($grantTypes));
        $this->assertCount(2, $grantTypes);
        $this->assertEquals('AUTHORIZATION_CODE', $grantTypes[0]);
        $this->assertEquals('IMPLICIT',           $grantTypes[1]);

        // applicationType
        $this->assertArrayHasKey('applicationType', $array);
        $this->assertEquals('WEB', $array['applicationType']);

        // contacts
        $this->assertArrayHasKey('contacts', $array);
        $contacts = $array['contacts'];

        $this->assertTrue(is_array($contacts));
        $this->assertCount(2, $contacts);
        $this->assertEquals("contact-0", $contacts[0]);
        $this->assertEquals("contact-1", $contacts[1]);

        // clientName
        $this->assertArrayHasKey('clientName', $array);
        $this->assertEquals(self::CLIENT_NAME, $array['clientName']);

        // clientNames
        $this->assertArrayHasKey('clientNames', $array);
        $clientNames = $array['clientNames'];

        $this->assertTrue(is_array($clientNames));
        $this->assertCount(2, $clientNames);

        $clientName0 = $clientNames[0];
        $this->assertTrue(is_array($clientName0));
        $this->assertArrayHasKey('tag',   $clientName0);
        $this->assertArrayHasKey('value', $clientName0);
        $this->assertEquals('client-name-tag-0',   $clientName0['tag']);
        $this->assertEquals('client-name-value-0', $clientName0['value']);

        $clientName1 = $clientNames[1];
        $this->assertTrue(is_array($clientName1));
        $this->assertArrayHasKey('tag',   $clientName1);
        $this->assertArrayHasKey('value', $clientName1);
        $this->assertEquals('client-name-tag-1',   $clientName1['tag']);
        $this->assertEquals('client-name-value-1', $clientName1['value']);

        // logoUri
        $this->assertArrayHasKey('logoUri', $array);
        $this->assertEquals(self::LOGO_URI, $array['logoUri']);

        // logoUris
        $this->assertArrayHasKey('logoUris', $array);
        $logoUris = $array['logoUris'];

        $this->assertTrue(is_array($logoUris));
        $this->assertCount(2, $logoUris);

        $logoUri0 = $logoUris[0];
        $this->assertTrue(is_array($logoUri0));
        $this->assertArrayHasKey('tag',   $logoUri0);
        $this->assertArrayHasKey('value', $logoUri0);
        $this->assertEquals('logo-uri-tag-0',   $logoUri0['tag']);
        $this->assertEquals('logo-uri-value-0', $logoUri0['value']);

        $logoUri1 = $logoUris[1];
        $this->assertTrue(is_array($logoUri1));
        $this->assertArrayHasKey('tag',   $logoUri1);
        $this->assertArrayHasKey('value', $logoUri1);
        $this->assertEquals('logo-uri-tag-1',   $logoUri1['tag']);
        $this->assertEquals('logo-uri-value-1', $logoUri1['value']);

        // description
        $this->assertArrayHasKey('description', $array);
        $this->assertEquals(self::DESCRIPTION, $array['description']);

        // descriptions
        $this->assertArrayHasKey('descriptions', $array);
        $descriptions = $array['descriptions'];

        $this->assertTrue(is_array($descriptions));
        $this->assertCount(2, $descriptions);

        $description0 = $descriptions[0];
        $this->assertTrue(is_array($description0));
        $this->assertArrayHasKey('tag',   $description0);
        $this->assertArrayHasKey('value', $description0);
        $this->assertEquals('description-tag-0',   $description0['tag']);
        $this->assertEquals('description-value-0', $description0['value']);

        $description1 = $descriptions[1];
        $this->assertTrue(is_array($description1));
        $this->assertArrayHasKey('tag',   $description1);
        $this->assertArrayHasKey('value', $description1);
        $this->assertEquals('description-tag-1',   $description1['tag']);
        $this->assertEquals('description-value-1', $description1['value']);
    }


    private static function createArrayOfTaggedValue()
    {
        $array = array(
            new TaggedValue('tag0', 'value0'),
            new TaggedValue('tag1', 'value1')
        );

        return $array;
    }


    private function checkArrayOfTaggedValue(array &$tags)
    {
        $this->assertTrue(is_array($tags));
        $this->assertCount(2, $tags);

        $tag0 = $tags[0];
        $this->assertInstanceOf(TaggedValue::class, $tag0);
        $this->assertEquals('tag0',   $tag0->getTag());
        $this->assertEquals('value0', $tag0->getValue());

        $tag1 = $tags[1];
        $this->assertInstanceOf(TaggedValue::class, $tag1);
        $this->assertEquals('tag1',   $tag1->getTag());
        $this->assertEquals('value1', $tag1->getValue());
    }
}
?>