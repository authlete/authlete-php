<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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


namespace Tests\Dto;



use Authlete\Dto\Client;
use Authlete\Dto\ClientExtension;
use Authlete\Dto\TaggedValue;
use Authlete\Types\ApplicationType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\ClientType;
use Authlete\Types\DeliveryMode;
use Authlete\Types\GrantType;
use Authlete\Types\JWEAlg;
use Authlete\Types\JWEEnc;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\SubjectType;
use Error;
use InvalidArgumentException;
use PharIo\Manifest\Type;
use PHPUnit\Framework\TestCase;


class ClientTest extends TestCase
{
    private const DEVELOPER = '_developer_';
    private const CLIENT_ID_INT = 1000;
    private const CLIENT_ID_STR = '1001';
    private const CLIENT_ID_ALIAS = '_client_id_alias_';
    private const CLIENT_SECRET = '_client_secret_';
    private const CLIENT_NAME = '_client_name_';
    private const LOGO_URI = '_logo_uri_';
    private const CLIENT_URI = '_client_uri_';
    private const POLICY_URI = '_policy_uri_';
    private const TOS_URI = '_tos_uri_';
    private const JWKS_URI = '_jwks_uri_';
    private const JWKS = '_jwks_';
    private const DERIVED_SECTOR_IDENTIFIER = '_derived_sector_identifier_';
    private const SECTOR_IDENTIFIER_URI = '_sector_identifier_uri_';
    private const DEFAULT_MAX_AGE_INT = 2000;
    private const DEFAULT_MAX_AGE_STR = '2001';
    private const LOGIN_URI = '_login_uri_';
    private const DESCRIPTION = '_description_';
    private const CREATED_AT_INT = 3000;
    private const CREATED_AT_STR = '3001';
    private const MODIFIED_AT_INT = 4000;
    private const MODIFIED_AT_STR = '4001';
    private const TLS_CLIENT_AUTH_SUBJECT_DN = '_tls_client_auth_subject_dn_';
    private const TLS_CLIENT_AUTH_SAN_DNS = '_tls_client_auth_san_dns_';
    private const TLS_CLIENT_AUTH_SAN_URI = '_tls_client_auth_san_uri_';
    private const TLS_CLIENT_AUTH_SAN_IP = '_tls_client_auth_san_ip_';
    private const TLS_CLIENT_AUTH_SAN_EMAIL = '_tls_client_auth_san_email_';
    private const SOFTWARE_ID = '_software_id_';
    private const SOFTWARE_VERSION = '_software_version_';
    private const BC_NOTIFICATION_ENDPOINT = '_bc_notification_endpoint_';
    private const REGISTRATION_ACCESS_TOKEN_HASH = '_registration_access_token_hash_';


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


    public function testDeveloperInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientIdInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientIdAliasInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientIdAliasEnabledInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setClientIdAliasEnabled($invalid);
    }


    public function testClientIdAliasEnabledInvalidNull()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientSecretInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setClientSecret($invalid);
    }


    public function testClientTypeValidValue()
    {
        $obj = new Client();

        $type = ClientType::PUBLIC;
        $obj->setClientType($type);

        $this->assertSame($type, $obj->getClientType());
    }


    public function testClientTypeValidNull()
    {
        $obj = new Client();
        $obj->setClientType(null);

        $this->assertNull($obj->getClientType());
    }


    public function testClientTypeInvalidValue()
    {
        $this->expectException(Error::class);
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


    public function testRedirectUrisInvalidString()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRedirectUris($invalid);
    }


    public function testRedirectUrisInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array(array(), array());
        $obj->setRedirectUris($invalid);
    }


    public function testResponseTypesValidValue()
    {
        $obj = new Client();

        $array = array(
            ResponseType::CODE,
            ResponseType::TOKEN
        );
        $obj->setResponseTypes($array);

        $types = $obj->getResponseTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertSame(ResponseType::CODE, $types[0]);
        $this->assertSame(ResponseType::TOKEN, $types[1]);
    }


    public function testResponseTypesValidNull()
    {
        $obj = new Client();
        $obj->setResponseTypes(null);

        $this->assertNull($obj->getResponseTypes());
    }


    public function testResponseTypesInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setResponseTypes($invalid);
    }


    public function testResponseTypesInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setResponseTypes($invalid);
    }


    public function testGrantTypesValidValue()
    {
        $obj = new Client();

        $array = array(
            GrantType::AUTHORIZATION_CODE,
            GrantType::IMPLICIT
        );
        $obj->setGrantTypes($array);

        $types = $obj->getGrantTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertSame(GrantType::AUTHORIZATION_CODE, $types[0]);
        $this->assertSame(GrantType::IMPLICIT, $types[1]);
    }


    public function testGrantTypesValidNull()
    {
        $obj = new Client();
        $obj->setGrantTypes(null);

        $this->assertNull($obj->getGrantTypes());
    }


    public function testGrantTypesInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setGrantTypes($invalid);
    }


    public function testGrantTypesInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setGrantTypes($invalid);
    }


    public function testApplicationTypeValidValue()
    {
        $obj = new Client();

        $type = ApplicationType::WEB;
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


    public function testContactsInvalidString()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setContacts($invalid);
    }


    public function testContactsInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientNameInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientNamesInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setClientNames($invalid);
    }


    public function testClientNamesInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testLogoUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testLogoUrisInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setLogoUris($invalid);
    }


    public function testLogoUrisInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testClientUrisInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setClientUris($invalid);
    }


    public function testClientUrisInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testPolicyUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testPolicyUrisInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setPolicyUris($invalid);
    }


    public function testPolicyUrisInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testTosUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testTosUrisInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setTosUris($invalid);
    }


    public function testTosUrisInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testJwksUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testJwksInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testSectorIdentifierUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setSectorIdentifierUri($invalid);
    }


    public function testSubjectTypeValidValue()
    {
        $obj = new Client();

        $type = SubjectType::PUBLIC;
        $obj->setSubjectType($type);

        $this->assertSame($type, $obj->getSubjectType());
    }


    public function testSubjectTypeValidNull()
    {
        $obj = new Client();
        $obj->setSubjectType(null);

        $this->assertNull($obj->getSubjectType());
    }


    public function testSubjectTypeInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setSubjectType($invalid);
    }


    public function testIdTokenSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::HS256;
        $obj->setIdTokenSignAlg($alg);

        $this->assertSame($alg, $obj->getIdTokenSignAlg());
    }


    public function testIdTokenSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenSignAlg(null);

        $this->assertNull($obj->getIdTokenSignAlg());
    }


    public function testIdTokenSignAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenSignAlg($invalid);
    }


    public function testIdTokenEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::RSA1_5;
        $obj->setIdTokenEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getIdTokenEncryptionAlg());
    }


    public function testIdTokenEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenEncryptionAlg(null);

        $this->assertNull($obj->getIdTokenEncryptionAlg());
    }


    public function testIdTokenEncryptionAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenEncryptionAlg($invalid);
    }


    public function testIdTokenEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::A128CBC_HS256;
        $obj->setIdTokenEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getIdTokenEncryptionEnc());
    }


    public function testIdTokenEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setIdTokenEncryptionEnc(null);

        $this->assertNull($obj->getIdTokenEncryptionEnc());
    }


    public function testIdTokenEncryptionEncInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setIdTokenEncryptionEnc($invalid);
    }


    public function testUserInfoSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::RS256;
        $obj->setUserInfoSignAlg($alg);

        $this->assertSame($alg, $obj->getUserInfoSignAlg());
    }


    public function testUserInfoSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoSignAlg(null);

        $this->assertNull($obj->getUserInfoSignAlg());
    }


    public function testUserInfoSignAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoSignAlg($invalid);
    }


    public function testUserInfoEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::A128KW;
        $obj->setUserInfoEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getUserInfoEncryptionAlg());
    }


    public function testUserInfoEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoEncryptionAlg(null);

        $this->assertNull($obj->getUserInfoEncryptionAlg());
    }


    public function testUserInfoEncryptionAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoEncryptionAlg($invalid);
    }


    public function testUserInfoEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::A128GCM;
        $obj->setUserInfoEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getUserInfoEncryptionEnc());
    }


    public function testUserInfoEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setUserInfoEncryptionEnc(null);

        $this->assertNull($obj->getUserInfoEncryptionEnc());
    }


    public function testUserInfoEncryptionEncInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setUserInfoEncryptionEnc($invalid);
    }


    public function testRequestSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::ES256;
        $obj->setRequestSignAlg($alg);

        $this->assertSame($alg, $obj->getRequestSignAlg());
    }


    public function testRequestSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setRequestSignAlg(null);

        $this->assertNull($obj->getRequestSignAlg());
    }


    public function testRequestSignAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestSignAlg($invalid);
    }


    public function testRequestEncryptionAlgValidValue()
    {
        $obj = new Client();

        $alg = JWEAlg::ECDH_ES;
        $obj->setRequestEncryptionAlg($alg);

        $this->assertSame($alg, $obj->getRequestEncryptionAlg());
    }


    public function testRequestEncryptionAlgValidNull()
    {
        $obj = new Client();
        $obj->setRequestEncryptionAlg(null);

        $this->assertNull($obj->getRequestEncryptionAlg());
    }


    public function testRequestEncryptionAlgInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestEncryptionAlg($invalid);
    }


    public function testRequestEncryptionEncValidValue()
    {
        $obj = new Client();

        $enc = JWEEnc::A192CBC_HS384;
        $obj->setRequestEncryptionEnc($enc);

        $this->assertSame($enc, $obj->getRequestEncryptionEnc());
    }


    public function testRequestEncryptionEncValidNull()
    {
        $obj = new Client();
        $obj->setRequestEncryptionEnc(null);

        $this->assertNull($obj->getRequestEncryptionEnc());
    }


    public function testRequestEncryptionEncInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestEncryptionEnc($invalid);
    }


    public function testTokenAuthMethodValidValue()
    {
        $obj = new Client();

        $method = ClientAuthMethod::CLIENT_SECRET_BASIC;
        $obj->setTokenAuthMethod($method);

        $this->assertSame($method, $obj->getTokenAuthMethod());
    }


    public function testTokenAuthMethodValidNull()
    {
        $obj = new Client();
        $obj->setTokenAuthMethod(null);

        $this->assertNull($obj->getTokenAuthMethod());
    }


    public function testTokenAuthMethodInvalidValue()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setTokenAuthMethod($invalid);
    }


    public function testTokenAuthSignAlgValidValue()
    {
        $obj = new Client();

        $alg = JWSAlg::PS256;
        $obj->setTokenAuthSignAlg($alg);

        $this->assertSame($alg, $obj->getTokenAuthSignAlg());
    }


    public function testTokenAuthSignAlgValidNull()
    {
        $obj = new Client();
        $obj->setTokenAuthSignAlg(null);

        $this->assertNull($obj->getTokenAuthSignAlg());
    }


    public function testTokenAuthSignAlgInvalidValue()
    {
        $this->expectException(Error::class);
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


    public function testDefaultMaxAgeInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setDefaultMaxAge($invalid);
    }


    public function testAuthTimeRequiredValidValue()
    {
        $obj = new Client();
        $obj->setAuthTimeRequired(true);

        $this->assertEquals(true, $obj->isAuthTimeRequired());
    }


    public function testAuthTimeRequiredInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setAuthTimeRequired($invalid);
    }


    public function testAuthTimeRequiredInvalidNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();
        $obj->setAuthTimeRequired(null);
    }


    public function testDefaultAcrsValidValue()
    {
        $obj = new Client();
        $obj->setDefaultAcrs(array('acr0', 'acr1'));

        $acrs = $obj->getDefaultAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr0', $acrs[0]);
        $this->assertEquals('acr1', $acrs[1]);
    }


    public function testDefaultAcrsValidNull()
    {
        $obj = new Client();
        $obj->setDefaultAcrs(null);

        $this->assertNull($obj->getDefaultAcrs());
    }


    public function testDefaultAcrsInvalidString()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setDefaultAcrs($invalid);
    }


    public function testDefaultAcrsInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array(array(), array());
        $obj->setDefaultAcrs($invalid);
    }


    public function testLoginUriValidValue()
    {
        $obj = new Client();
        $obj->setLoginUri(self::LOGIN_URI);

        $this->assertEquals(self::LOGIN_URI, $obj->getLoginUri());
    }


    public function testLoginUriValidNull()
    {
        $obj = new Client();
        $obj->setLoginUri(null);

        $this->assertNull($obj->getLoginUri());
    }


    public function testLoginUriInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setLoginUri($invalid);
    }


    public function testRequestUrisValidValue()
    {
        $obj = new Client();
        $obj->setRequestUris(array('uri0', 'uri1'));

        $uris = $obj->getRequestUris();

        $this->assertTrue(is_array($uris));
        $this->assertCount(2, $uris);
        $this->assertEquals('uri0', $uris[0]);
        $this->assertEquals('uri1', $uris[1]);
    }


    public function testRequestUrisValidNull()
    {
        $obj = new Client();
        $obj->setRequestUris(null);

        $this->assertNull($obj->getRequestUris());
    }


    public function testRequestUrisInvalidString()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setRequestUris($invalid);
    }


    public function testRequestUrisInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array(array(), array());
        $obj->setRequestUris($invalid);
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


    public function testDescriptionInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testDescriptionsInvalidType()
    {
        $this->expectException(Error::class);
        $obj = new Client();

        $invalid = '__INVALID__';
        $obj->setDescriptions($invalid);
    }


    public function testDescriptionsInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array('__INVALID__');
        $obj->setDescriptions($invalid);
    }


    public function testCreatedAtValidInt()
    {
        $obj = new Client();
        $obj->setCreatedAt(self::CREATED_AT_INT);

        $this->assertEquals(self::CREATED_AT_INT, $obj->getCreatedAt());
    }


    public function testCreatedAtValidStr()
    {
        $obj = new Client();
        $obj->setCreatedAt(self::CREATED_AT_STR);

        $this->assertEquals(self::CREATED_AT_STR, $obj->getCreatedAt());
    }


    public function testCreatedAtValidNull()
    {
        $obj = new Client();
        $obj->setCreatedAt(null);

        $this->assertNull($obj->getCreatedAt());
    }


    public function testCreatedAtInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setCreatedAt($invalid);
    }


    public function testModifiedAtValidInt()
    {
        $obj = new Client();
        $obj->setModifiedAt(self::MODIFIED_AT_INT);

        $this->assertEquals(self::MODIFIED_AT_INT, $obj->getModifiedAt());
    }


    public function testModifiedAtValidStr()
    {
        $obj = new Client();
        $obj->setModifiedAt(self::MODIFIED_AT_STR);

        $this->assertEquals(self::MODIFIED_AT_STR, $obj->getModifiedAt());
    }


    public function testModifiedAtValidNull()
    {
        $obj = new Client();
        $obj->setModifiedAt(null);

        $this->assertNull($obj->getModifiedAt());
    }


    public function testModifiedAtInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setModifiedAt($invalid);
    }


    public function testExtensionValidValue()
    {
        $extension = new ClientExtension();
        $extension->setRequestableScopesEnabled(true);

        $obj = new Client();
        $obj->setExtension($extension);

        $this->assertSame($extension, $obj->getExtension());
    }


    public function testExtensionValidNull()
    {
        $obj = new Client();
        $obj->setExtension(null);

        $this->assertNull($obj->getExtension());
    }


    public function testExtensionInvalidValue()
    {
        $this->expectException(\TypeError::class);
        $obj = new Client();

        $invalid = array();
        $obj->setExtension($invalid);
    }


    public function testTlsClientAuthSubjectDnValidValue()
    {
        $obj = new Client();
        $obj->setTlsClientAuthSubjectDn(self::TLS_CLIENT_AUTH_SUBJECT_DN);

        $this->assertEquals(self::TLS_CLIENT_AUTH_SUBJECT_DN, $obj->getTlsClientAuthSubjectDn());
    }


    public function testTlsClientAuthSubjectDnValidNull()
    {
        $obj = new Client();
        $obj->setTlsClientAuthSubjectDn(null);

        $this->assertNull($obj->getTlsClientAuthSubjectDn());
    }


    public function testTlsClientAuthSubjectDnInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setTlsClientAuthSubjectDn($invalid);
    }


    public function testTlsClientCertificateBoundAccessTokensValidValue()
    {
        $obj = new Client();
        $obj->setTlsClientCertificateBoundAccessTokens(true);

        $this->assertEquals(true, $obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testTlsClientCertificateBoundAccessTokensInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();

        $invalid = array();
        $obj->setTlsClientCertificateBoundAccessTokens($invalid);
    }


    public function testTlsClientCertificateBoundAccessTokensInvalidNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Client();
        $obj->setTlsClientCertificateBoundAccessTokens(null);
    }


    public function testSelfSignedCertificateKeyIdValidValue()
    {
        $obj = new Client();
        $obj->setSelfSignedCertificateKeyId('keyId');

        $this->assertEquals('keyId', $obj->getSelfSignedCertificateKeyId());
    }


    public function testSelfSignedCertificateKeyIdValidNull()
    {
        $obj = new Client();
        $obj->setSelfSignedCertificateKeyId(null);

        $this->assertNull($obj->getSelfSignedCertificateKeyId());
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj = Client::fromJson($json);

        $this->assertInstanceof(Client::class, $obj);
    }


    public function testFromJsonDeveloperValidValue()
    {
        $json = '{"developer":"' . self::DEVELOPER . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::DEVELOPER, $obj->getDeveloper());
    }


    public function testFromJsonDeveloperValidNull()
    {
        $json = '{"developer":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getDeveloper());
    }


    public function testFromJsonDeveloperInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"developer":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDeveloperInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"developer":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDeveloperInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"developer":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDeveloperInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"developer":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdValidInt()
    {
        $json = '{"clientId":1}';
        $obj = Client::fromJson($json);

        $this->assertEquals(1, $obj->getClientId());
    }


    public function testFromJsonClientIdValidStr()
    {
        $json = '{"clientId":"2"}';
        $obj = Client::fromJson($json);

        $this->assertEquals("2", $obj->getClientId());
    }


    public function testFromJsonClientIdValidNull()
    {
        $json = '{"clientId":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientId());
    }


    public function testFromJsonClientIdInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientId":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasValidValue()
    {
        $json = '{"clientIdAlias":"alias"}';
        $obj = Client::fromJson($json);

        $this->assertEquals('alias', $obj->getClientIdAlias());
    }


    public function testFromJsonClientIdAliasValidNull()
    {
        $json = '{"clientIdAlias":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientIdAlias());
    }


    public function testFromJsonClientIdAliasInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientIdAlias":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientIdAlias":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientIdAlias":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientIdAlias":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientIdAliasEnabledValidValue()
    {
        $json = '{"clientIdAliasEnabled":true}';
        $obj = Client::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidNull()
    {
        $json = '{"clientIdAliasEnabled":null}';
        $obj = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidStringTrue()
    {
        $json = '{"clientIdAliasEnabled":"true"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledValidStringFalse()
    {
        $json = '{"clientIdAliasEnabled":"false"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledInvalidString()
    {
        $json = '{"clientIdAliasEnabled":"__INVALID__"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasEnabled());
    }


    public function testFromJsonClientIdAliasEnabledInvalidType()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientIdAliasEnabled":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientSecretValidValue()
    {
        $json = '{"clientSecret":"secret"}';
        $obj = Client::fromJson($json);

        $this->assertEquals('secret', $obj->getClientSecret());
    }


    public function testFromJsonClientSecretValidNull()
    {
        $json = '{"clientSecret":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientSecret());
    }


    public function testFromJsonClientSecretInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientSecretInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientSecret":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientTypeValidValue()
    {
        $json = '{"clientType":"PUBLIC"}';
        $obj = Client::fromJson($json);

        $this->assertSame(ClientType::PUBLIC, $obj->getClientType());
    }


    public function testFromJsonClientTypeValidNull()
    {
        $json = '{"clientType":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientType());
    }


    public function testFromJsonClientTypeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientType":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientTypeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientType":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientTypeInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"clientType":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientTypeInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"clientType":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRedirectUrisValidValue()
    {
        $json = '{"redirectUris":["uri0","uri1"]}';
        $obj = Client::fromJson($json);

        $uris = $obj->getRedirectUris();

        $this->assertTrue(is_array($uris));
        $this->assertCount(2, $uris);
        $this->assertEquals('uri0', $uris[0]);
        $this->assertEquals('uri1', $uris[1]);
    }


    public function testFromJsonRedirectUrisValidNull()
    {
        $json = '{"redirectUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getRedirectUris());
    }


    public function testFromJsonRedirectUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"redirectUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRedirectUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"redirectUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonResponseTypesValidValue()
    {
        $json = '{"responseTypes":["CODE","TOKEN"]}';
        $obj = Client::fromJson($json);

        $types = $obj->getResponseTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertEquals(ResponseType::CODE, $types[0]);
        $this->assertEquals(ResponseType::TOKEN, $types[1]);
    }


    public function testFromJsonResponseTypesValidNull()
    {
        $json = '{"responseTypes":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getResponseTypes());
    }


    public function testFromJsonResponseTypesInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"responseTypes":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonResponseTypesInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"responseTypes":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonResponseTypesInvalidString()
    {
        $this->expectException(Error::class);
        $json = '{"responseTypes":"__INVALID__"}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonResponseTypesInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseTypes":["__INVALID__"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonGrantTypesValidValue()
    {
        $json = '{"grantTypes":["AUTHORIZATION_CODE","IMPLICIT"]}';
        $obj = Client::fromJson($json);

        $types = $obj->getGrantTypes();

        $this->assertTrue(is_array($types));
        $this->assertCount(2, $types);
        $this->assertEquals(GrantType::AUTHORIZATION_CODE, $types[0]);
        $this->assertEquals(GrantType::IMPLICIT, $types[1]);
    }


    public function testFromJsonGrantTypesValidNull()
    {
        $json = '{"grantTypes":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getGrantTypes());
    }


    public function testFromJsonGrantTypesInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"grantTypes":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonGrantTypesInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"grantTypes":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonGrantTypesInvalidString()
    {
        $this->expectException(Error::class);
        $json = '{"grantTypes":"__INVALID__"}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonGrantTypesInvalidElement()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"grantTypes":["__INVALID__"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonApplicationTypeValidValue()
    {
        $json = '{"applicationType":"WEB"}';
        $obj = Client::fromJson($json);

        $this->assertSame(ApplicationType::WEB, $obj->getApplicationType());
    }


    public function testFromJsonApplicationTypeValidNull()
    {
        $json = '{"applicationType":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getApplicationType());
    }


    public function testFromJsonApplicationTypeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"applicationType":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonApplicationTypeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"applicationType":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonApplicationTypeInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"applicationType":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonApplicationTypeInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"applicationType":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonContactsValidValue()
    {
        $json = '{"contacts":["contact0","contact1"]}';
        $obj = Client::fromJson($json);

        $contacts = $obj->getContacts();

        $this->assertTrue(is_array($contacts));
        $this->assertCount(2, $contacts);
        $this->assertEquals('contact0', $contacts[0]);
        $this->assertEquals('contact1', $contacts[1]);
    }


    public function testFromJsonContactsValidNull()
    {
        $json = '{"contacts":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getContacts());
    }


    public function testFromJsonContactsInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"contacts":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonContactsInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"contacts":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNameValidValue()
    {
        $json = '{"clientName":"' . self::CLIENT_NAME . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::CLIENT_NAME, $obj->getClientName());
    }


    public function testFromJsonClientNameValidNull()
    {
        $json = '{"clientName":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientName());
    }


    public function testFromJsonClientNameInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientName":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNameInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientName":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNameInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientName":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNameInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientName":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNamesValidValue()
    {
        $json = '{"clientNames":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getClientNames();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonClientNamesValidNull()
    {
        $json = '{"clientNames":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientNames());
    }


    public function testFromJsonClientNamesInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"clientNames":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNamesInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"clientNames":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNamesInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"clientNames":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientNamesInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"clientNames":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUriValidValue()
    {
        $json = '{"logoUri":"' . self::LOGO_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::LOGO_URI, $obj->getLogoUri());
    }


    public function testFromJsonLogoUriValidNull()
    {
        $json = '{"logoUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getLogoUri());
    }


    public function testFromJsonLogoUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"logoUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"logoUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"logoUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"logoUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUrisValidValue()
    {
        $json = '{"logoUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getLogoUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonLogoUrisValidNull()
    {
        $json = '{"logoUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getLogoUris());
    }


    public function testFromJsonLogoUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"logoUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"logoUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUrisInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"logoUris":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLogoUrisInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"logoUris":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUriValidValue()
    {
        $json = '{"clientUri":"' . self::CLIENT_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::CLIENT_URI, $obj->getClientUri());
    }


    public function testFromJsonClientUriValidNull()
    {
        $json = '{"clientUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientUri());
    }


    public function testFromJsonClientUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"clientUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUrisValidValue()
    {
        $json = '{"clientUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getClientUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonClientUrisValidNull()
    {
        $json = '{"clientUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getClientUris());
    }


    public function testFromJsonClientUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"clientUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"clientUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUrisInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"clientUris":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonClientUrisInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"clientUris":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUriValidValue()
    {
        $json = '{"policyUri":"' . self::POLICY_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::POLICY_URI, $obj->getPolicyUri());
    }


    public function testFromJsonPolicyUriValidNull()
    {
        $json = '{"policyUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getPolicyUri());
    }


    public function testFromJsonPolicyUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"policyUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"policyUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"policyUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"policyUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUrisValidValue()
    {
        $json = '{"policyUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getPolicyUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonPolicyUrisValidNull()
    {
        $json = '{"policyUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getPolicyUris());
    }


    public function testFromJsonPolicyUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"policyUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"policyUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUrisInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"policyUris":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonPolicyUrisInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"policyUris":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUriValidValue()
    {
        $json = '{"tosUri":"' . self::TOS_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::TOS_URI, $obj->getTosUri());
    }


    public function testFromJsonTosUriValidNull()
    {
        $json = '{"tosUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getTosUri());
    }


    public function testFromJsonTosUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tosUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tosUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tosUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tosUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUrisValidValue()
    {
        $json = '{"tosUris":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getTosUris();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonTosUrisValidNull()
    {
        $json = '{"tosUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getTosUris());
    }


    public function testFromJsonTosUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"tosUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"tosUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUrisInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"tosUris":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTosUrisInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"tosUris":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksUriValidValue()
    {
        $json = '{"jwksUri":"' . self::JWKS_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::JWKS_URI, $obj->getJwksUri());
    }


    public function testFromJsonJwksUriValidNull()
    {
        $json = '{"jwksUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getJwksUri());
    }


    public function testFromJsonJwksUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwksUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwksUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwksUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwksUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksValidValue()
    {
        $json = '{"jwks":"' . self::JWKS . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::JWKS, $obj->getJwks());
    }


    public function testFromJsonJwksValidNull()
    {
        $json = '{"jwks":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getJwks());
    }


    public function testFromJsonJwksInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwks":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwks":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwks":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonJwksInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"jwks":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSectorIdentifierUriValidValue()
    {
        $json = '{"sectorIdentifierUri":"' . self::SECTOR_IDENTIFIER_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::SECTOR_IDENTIFIER_URI, $obj->getSectorIdentifierUri());
    }


    public function testFromJsonSectorIdentifierUriValidNull()
    {
        $json = '{"sectorIdentifierUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getSectorIdentifierUri());
    }


    public function testFromJsonSectorIdentifierUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"sectorIdentifierUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSectorIdentifierUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"sectorIdentifierUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSectorIdentifierUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"sectorIdentifierUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSectorIdentifierUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"sectorIdentifierUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSubjectTypeValidValue()
    {
        $json = '{"subjectType":"PUBLIC"}';
        $obj = Client::fromJson($json);

        $this->assertSame(SubjectType::PUBLIC, $obj->getSubjectType());
    }


    public function testFromJsonSubjectTypeValidNull()
    {
        $json = '{"subjectType":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getSubjectType());
    }


    public function testFromJsonSubjectTypeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"subjectType":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSubjectTypeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"subjectType":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSubjectTypeInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"subjectType":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSubjectTypeInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"subjectType":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenSignAlgValidValue()
    {
        $json = '{"idTokenSignAlg":"HS256"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWSAlg::HS256, $obj->getIdTokenSignAlg());
    }


    public function testFromJsonIdTokenSignAlgValidNull()
    {
        $json = '{"idTokenSignAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenSignAlg());
    }


    public function testFromJsonIdTokenSignAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenSignAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenSignAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenSignAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenSignAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenSignAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenSignAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenSignAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionAlgValidValue()
    {
        $json = '{"idTokenEncryptionAlg":"RSA1_5"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEAlg::RSA1_5, $obj->getIdTokenEncryptionAlg());
    }


    public function testFromJsonIdTokenEncryptionAlgValidNull()
    {
        $json = '{"idTokenEncryptionAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenEncryptionAlg());
    }


    public function testFromJsonIdTokenEncryptionAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenEncryptionAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenEncryptionAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenEncryptionAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenEncryptionAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionEncValidValue()
    {
        $json = '{"idTokenEncryptionEnc":"A128CBC_HS256"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEEnc::A128CBC_HS256, $obj->getIdTokenEncryptionEnc());
    }


    public function testFromJsonIdTokenEncryptionEncValidNull()
    {
        $json = '{"idTokenEncryptionEnc":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getIdTokenEncryptionEnc());
    }


    public function testFromJsonIdTokenEncryptionEncInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenEncryptionEnc":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionEncInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"idTokenEncryptionEnc":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionEncInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenEncryptionEnc":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonIdTokenEncryptionEncInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"idTokenEncryptionEnc":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoSignAlgValidValue()
    {
        $json = '{"userInfoSignAlg":"RS256"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWSAlg::RS256, $obj->getUserInfoSignAlg());
    }


    public function testFromJsonUserInfoSignAlgValidNull()
    {
        $json = '{"userInfoSignAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoSignAlg());
    }


    public function testFromJsonUserInfoSignAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoSignAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoSignAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoSignAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoSignAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoSignAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoSignAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoSignAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionAlgValidValue()
    {
        $json = '{"userInfoEncryptionAlg":"A128KW"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEAlg::A128KW, $obj->getUserInfoEncryptionAlg());
    }


    public function testFromJsonUserInfoEncryptionAlgValidNull()
    {
        $json = '{"userInfoEncryptionAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoEncryptionAlg());
    }


    public function testFromJsonUserInfoEncryptionAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoEncryptionAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoEncryptionAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoEncryptionAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoEncryptionAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionEncValidValue()
    {
        $json = '{"userInfoEncryptionEnc":"A128GCM"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEEnc::A128GCM, $obj->getUserInfoEncryptionEnc());
    }


    public function testFromJsonUserInfoEncryptionEncValidNull()
    {
        $json = '{"userInfoEncryptionEnc":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getUserInfoEncryptionEnc());
    }


    public function testFromJsonUserInfoEncryptionEncInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoEncryptionEnc":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionEncInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"userInfoEncryptionEnc":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionEncInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoEncryptionEnc":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonUserInfoEncryptionEncInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"userInfoEncryptionEnc":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestSignAlgValidValue()
    {
        $json = '{"requestSignAlg":"ES256"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWSAlg::ES256, $obj->getRequestSignAlg());
    }


    public function testFromJsonRequestSignAlgValidNull()
    {
        $json = '{"requestSignAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getRequestSignAlg());
    }


    public function testFromJsonRequestSignAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestSignAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestSignAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestSignAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestSignAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestSignAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestSignAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestSignAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionAlgValidValue()
    {
        $json = '{"requestEncryptionAlg":"ECDH_ES"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEAlg::ECDH_ES, $obj->getRequestEncryptionAlg());
    }


    public function testFromJsonRequestEncryptionAlgValidNull()
    {
        $json = '{"requestEncryptionAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getRequestEncryptionAlg());
    }


    public function testFromJsonRequestEncryptionAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestEncryptionAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestEncryptionAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestEncryptionAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestEncryptionAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionEncValidValue()
    {
        $json = '{"requestEncryptionEnc":"A256GCM"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWEEnc::A256GCM, $obj->getRequestEncryptionEnc());
    }


    public function testFromJsonRequestEncryptionEncValidNull()
    {
        $json = '{"requestEncryptionEnc":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getRequestEncryptionEnc());
    }


    public function testFromJsonRequestEncryptionEncInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestEncryptionEnc":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionEncInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"requestEncryptionEnc":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionEncInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestEncryptionEnc":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestEncryptionEncInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"requestEncryptionEnc":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthMethodValidValue()
    {
        $json = '{"tokenAuthMethod":"CLIENT_SECRET_POST"}';
        $obj = Client::fromJson($json);

        $this->assertSame(ClientAuthMethod::CLIENT_SECRET_POST, $obj->getTokenAuthMethod());
    }


    public function testFromJsonTokenAuthMethodValidNull()
    {
        $json = '{"tokenAuthMethod":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getTokenAuthMethod());
    }


    public function testFromJsonTokenAuthMethodInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tokenAuthMethod":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthMethodInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tokenAuthMethod":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthMethodInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"tokenAuthMethod":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthMethodInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"tokenAuthSignAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthSignAlgValidValue()
    {
        $json = '{"tokenAuthSignAlg":"ES256"}';
        $obj = Client::fromJson($json);

        $this->assertSame(JWSAlg::ES256, $obj->getTokenAuthSignAlg());
    }


    public function testFromJsonTokenAuthSignAlgValidNull()
    {
        $json = '{"tokenAuthSignAlg":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getTokenAuthSignAlg());
    }


    public function testFromJsonTokenAuthSignAlgInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tokenAuthSignAlg":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthSignAlgInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tokenAuthSignAlg":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthSignAlgInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"tokenAuthSignAlg":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTokenAuthSignAlgInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"tokenAuthSignAlg":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDefaultMaxAgeValidInt()
    {
        $json = '{"defaultMaxAge":1}';
        $obj = Client::fromJson($json);

        $this->assertEquals(1, $obj->getDefaultMaxAge());
    }


    public function testFromJsonDefaultMaxAgeValidStr()
    {
        $json = '{"defaultMaxAge":"2"}';
        $obj = Client::fromJson($json);

        $this->assertEquals("2", $obj->getDefaultMaxAge());
    }


    public function testFromJsonDefaultMaxAgeValidNull()
    {
        $json = '{"defaultMaxAge":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getDefaultMaxAge());
    }


    public function testFromJsonDefaultMaxAgeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"defaultMaxAge":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDefaultMaxAgeInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"defaultMaxAge":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDefaultMaxAgeInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"defaultMaxAge":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonAuthTimeRequiredValidValue()
    {
        $json = '{"authTimeRequired":true}';
        $obj = Client::fromJson($json);

        $this->assertEquals(true, $obj->isAuthTimeRequired());
    }


    public function testFromJsonAuthTimeRequiredValidNull()
    {
        $json = '{"authTimeRequired":null}';
        $obj = Client::fromJson($json);

        $this->assertFalse($obj->isAuthTimeRequired());
    }


    public function testFromJsonAuthTimeRequiredValidStringTrue()
    {
        $json = '{"authTimeRequired":"true"}';
        $obj = Client::fromJson($json);

        $this->assertTrue($obj->isAuthTimeRequired());
    }


    public function testFromJsonAuthTimeRequiredValidStringFalse()
    {
        $json = '{"authTimeRequired":"false"}';
        $obj = Client::fromJson($json);

        $this->assertFalse($obj->isAuthTimeRequired());
    }


    public function testFromJsonAuthTimeRequiredInvalidString()
    {
        $json = '{"authTimeRequired":"__INVALID__"}';
        $obj = Client::fromJson($json);

        $this->assertFalse($obj->isAuthTimeRequired());
    }


    public function testFromJsonAuthTimeRequiredInvalidType()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"authTimeRequired":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDefaultAcrsValidValue()
    {
        $json = '{"defaultAcrs":["acr0","acr1"]}';
        $obj = Client::fromJson($json);

        $acrs = $obj->getDefaultAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr0', $acrs[0]);
        $this->assertEquals('acr1', $acrs[1]);
    }


    public function testFromJsonDefaultAcrsValidNull()
    {
        $json = '{"defaultAcrs":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getDefaultAcrs());
    }


    public function testFromJsonDefaultAcrsInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"defaultAcrs":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDefaultAcrsInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"defaultAcrs":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLoginUriValidValue()
    {
        $json = '{"loginUri":"' . self::LOGIN_URI . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::LOGIN_URI, $obj->getLoginUri());
    }


    public function testFromJsonLoginUriValidNull()
    {
        $json = '{"loginUri":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getLoginUri());
    }


    public function testFromJsonLoginUriInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"loginUri":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLoginUriInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"loginUri":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLoginUriInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"loginUri":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonLoginUriInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"loginUri":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestUrisValidValue()
    {
        $json = '{"requestUris":["uri0","uri1"]}';
        $obj = Client::fromJson($json);

        $uris = $obj->getRequestUris();

        $this->assertTrue(is_array($uris));
        $this->assertCount(2, $uris);
        $this->assertEquals('uri0', $uris[0]);
        $this->assertEquals('uri1', $uris[1]);
    }


    public function testFromJsonRequestUrisValidNull()
    {
        $json = '{"requestUris":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getRequestUris());
    }


    public function testFromJsonRequestUrisInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"requestUris":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonRequestUrisInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"requestUris":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionValidValue()
    {
        $json = '{"description":"' . self::DESCRIPTION . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());
    }


    public function testFromJsonDescriptionValidNull()
    {
        $json = '{"description":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getDescription());
    }


    public function testFromJsonDescriptionInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"description":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"description":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"description":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"description":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionsValidValue()
    {
        $json = '{"descriptions":[{"tag":"tag0","value":"value0"},{"tag":"tag1","value":"value1"}]}';
        $obj = Client::fromJson($json);

        $tags = $obj->getDescriptions();
        $this->checkArrayOfTaggedValue($tags);
    }


    public function testFromJsonDescriptionsValidNull()
    {
        $json = '{"descriptions":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getDescriptions());
    }


    public function testFromJsonDescriptionsInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"descriptions":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionsInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"descriptions":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionsInvalidArray()
    {
        $this->expectException(Error::class);
        $json = '{"descriptions":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonDescriptionsInvalidObject()
    {
        $this->expectException(Error::class);
        $json = '{"descriptions":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonCreatedAtValidInt()
    {
        $json = '{"createdAt":1}';
        $obj = Client::fromJson($json);

        $this->assertEquals(1, $obj->getCreatedAt());
    }


    public function testFromJsonCreatedAtValidStr()
    {
        $json = '{"createdAt":"2"}';
        $obj = Client::fromJson($json);

        $this->assertEquals("2", $obj->getCreatedAt());
    }


    public function testFromJsonCreatedAtValidNull()
    {
        $json = '{"createdAt":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getCreatedAt());
    }


    public function testFromJsonCreatedAtInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"createdAt":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonCreatedAtInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"createdAt":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonCreatedAtInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"createdAt":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonModifiedAtValidInt()
    {
        $json = '{"modifiedAt":1}';
        $obj = Client::fromJson($json);

        $this->assertEquals(1, $obj->getModifiedAt());
    }


    public function testFromJsonModifiedAtValidStr()
    {
        $json = '{"modifiedAt":"2"}';
        $obj = Client::fromJson($json);

        $this->assertEquals("2", $obj->getModifiedAt());
    }


    public function testFromJsonModifiedAtValidNull()
    {
        $json = '{"modifiedAt":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getModifiedAt());
    }


    public function testFromJsonModifiedAtInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"modifiedAt":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonModifiedAtInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"modifiedAt":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonModifiedAtInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"modifiedAt":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonExtensionValidValue()
    {
        $json = '{"extension":{"requestableScopesEnabled":true, "requestableScopes":["scope0","scope1"]}}';
        $obj = Client::fromJson($json);

        $extension = $obj->getExtension();
        $this->assertInstanceOf('\Authlete\Dto\ClientExtension', $extension);
        $this->assertTrue($extension->isRequestableScopesEnabled());

        $scopes = $extension->getRequestableScopes();
        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);
        $this->assertEquals('scope0', $scopes[0]);
        $this->assertEquals('scope1', $scopes[1]);
    }


    public function testFromJsonExtensionValidNull()
    {
        $json = '{"extension":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getExtension());
    }


    public function testFromJsonExtensionInvalidBool()
    {
        $this->expectException(Error::class);
        $json = '{"extension":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonExtensionInvalidNumber()
    {
        $this->expectException(Error::class);
        $json = '{"extension":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonExtensionInvalidString()
    {
        $this->expectException(Error::class);
        $json = '{"extension":"__INVALID__"}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTlsClientAuthSubjectDnValidValue()
    {
        $json = '{"tlsClientAuthSubjectDn":"' . self::TLS_CLIENT_AUTH_SUBJECT_DN . '"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(self::TLS_CLIENT_AUTH_SUBJECT_DN, $obj->getTlsClientAuthSubjectDn());
    }


    public function testFromJsonTlsClientAuthSubjectDnValidNull()
    {
        $json = '{"tlsClientAuthSubjectDn":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getTlsClientAuthSubjectDn());
    }


    public function testFromJsonTlsClientAuthSubjectDnInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tlsClientAuthSubjectDn":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTlsClientAuthSubjectDnInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tlsClientAuthSubjectDn":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTlsClientAuthSubjectDnInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tlsClientAuthSubjectDn":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTlsClientAuthSubjectDnInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tlsClientAuthSubjectDn":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensValidValue()
    {
        $json = '{"tlsClientCertificateBoundAccessTokens":true}';
        $obj = Client::fromJson($json);

        $this->assertTrue($obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensValidNull()
    {
        $json = '{"tlsClientCertificateBoundAccessTokens":null}';
        $obj = Client::fromJson($json);

        $this->assertFalse($obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensValidStringTrue()
    {
        $json = '{"tlsClientCertificateBoundAccessTokens":"true"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(true, $obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensValidStringFalse()
    {
        $json = '{"tlsClientCertificateBoundAccessTokens":"false"}';
        $obj = Client::fromJson($json);

        $this->assertEquals(false, $obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensInvalidString()
    {
        $json = '{"tlsClientCertificateBoundAccessTokens":"__INVALID__"}';
        $obj = Client::fromJson($json);

        $this->assertFalse($obj->isTlsClientCertificateBoundAccessTokens());
    }


    public function testFromJsonTlsClientCertificateBoundAccessTokensInvalidType()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"tlsClientCertificateBoundAccessTokens":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSelfSignedCertificateKeyIdValidValue()
    {
        $json = '{"selfSignedCertificateKeyId":"keyId"}';
        $obj = Client::fromJson($json);

        $this->assertEquals('keyId', $obj->getSelfSignedCertificateKeyId());
    }


    public function testFromJsonSelfSignedCertificateKeyIdValidNull()
    {
        $json = '{"selfSignedCertificateKeyId":null}';
        $obj = Client::fromJson($json);

        $this->assertNull($obj->getSelfSignedCertificateKeyId());
    }


    public function testFromJsonSelfSignedCertificateKeyIdInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"selfSignedCertificateKeyId":true}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSelfSignedCertificateKeyIdInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"selfSignedCertificateKeyId":123}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSelfSignedCertificateKeyIdInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"selfSignedCertificateKeyId":["a","b"]}';
        $obj = Client::fromJson($json);
    }


    public function testFromJsonSelfSignedCertificateKeyIdInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"selfSignedCertificateKeyId":{"a":"b"}}';
        $obj = Client::fromJson($json);
    }


    public function buildObj(): Client
    {
        $obj = new Client();
        $obj->setDeveloper(self::DEVELOPER)
            ->setClientId(self::CLIENT_ID_INT)
            ->setClientIdAlias(self::CLIENT_ID_ALIAS)
            ->setClientIdAliasEnabled(true)
            ->setClientSecret(self::CLIENT_SECRET)
            ->setClientType(ClientType::PUBLIC)
            ->setRedirectUris(
                array(
                    "redirect_uri-0",
                    "redirect_uri-1"
                )
            )
            ->setResponseTypes(
                array(
                    ResponseType::CODE->value,
                    ResponseType::TOKEN->value
                )
            )
            ->setGrantTypes(
                array(
                    GrantType::AUTHORIZATION_CODE->value,
                    GrantType::IMPLICIT->value
                )
            )
            ->setApplicationType(ApplicationType::WEB)
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
            ->setClientUri(self::CLIENT_URI)
            ->setClientUris(
                array(
                    new TaggedValue('client-uri-tag-0', 'client-uri-value-0'),
                    new TaggedValue('client-uri-tag-1', 'client-uri-value-1')
                )
            )
            ->setPolicyUri(self::POLICY_URI)
            ->setPolicyUris(
                array(
                    new TaggedValue('policy-uri-tag-0', 'policy-uri-value-0'),
                    new TaggedValue('policy-uri-tag-1', 'policy-uri-value-1')
                )
            )
            ->setTosUri(self::TOS_URI)
            ->setTosUris(
                array(
                    new TaggedValue('tos-uri-tag-0', 'tos-uri-value-0'),
                    new TaggedValue('tos-uri-tag-1', 'tos-uri-value-1')
                )
            )
            ->setJwksUri(self::JWKS_URI)
            ->setJwks(self::JWKS)
            ->setDerivedSectorIdentifier(self::DERIVED_SECTOR_IDENTIFIER)
            ->setSectorIdentifierUri(self::SECTOR_IDENTIFIER_URI)
            ->setSubjectType(SubjectType::PUBLIC)
            ->setIdTokenSignAlg(JWSAlg::HS256)
            ->setIdTokenEncryptionAlg(JWEAlg::A128KW)
            ->setIdTokenEncryptionEnc(JWEEnc::A128CBC_HS256)
            ->setUserInfoSignAlg(JWSAlg::HS256)
            ->setUserInfoEncryptionAlg(JWEAlg::A128KW)
            ->setUserInfoEncryptionEnc(JWEEnc::A128CBC_HS256)
            ->setRequestSignAlg(JWSAlg::HS256)
            ->setRequestEncryptionAlg(JWEAlg::A128KW)
            ->setRequestEncryptionEnc(JWEEnc::A128CBC_HS256)
            ->setTokenAuthMethod(ClientAuthMethod::CLIENT_SECRET_POST)
            ->setTokenAuthSignAlg(JWSAlg::HS256)
            ->setDefaultMaxAge(self::DEFAULT_MAX_AGE_INT)
            ->setAuthTimeRequired(true)
            ->setDefaultAcrs(
                array(
                    "acr-0",
                    "acr-1"
                )
            )
            ->setLoginUri(self::LOGIN_URI)
            ->setRequestUris(
                array(
                    "request_uri-0",
                    "request_uri-1"
                )
            )
            ->setDescription(self::DESCRIPTION)
            ->setDescriptions(
                array(
                    new TaggedValue('description-tag-0', 'description-value-0'),
                    new TaggedValue('description-tag-1', 'description-value-1')
                )
            )
            ->setCreatedAt(self::CREATED_AT_INT)
            ->setModifiedAt(self::MODIFIED_AT_INT)
            ->setExtension(
                (new ClientExtension())
                    ->setRequestableScopesEnabled(true)
                    ->setRequestableScopes(
                        array(
                            "requestable_scope-0",
                            "requestable_scope-1"
                        )
                    )
            )
            ->setTlsClientAuthSubjectDn(self::TLS_CLIENT_AUTH_SUBJECT_DN)
            ->setTlsClientAuthSanDns(self::TLS_CLIENT_AUTH_SAN_DNS)
            ->setTlsClientAuthSanUri(self::TLS_CLIENT_AUTH_SAN_URI)
            ->setTlsClientAuthSanIp(self::TLS_CLIENT_AUTH_SAN_IP)
            ->setTlsClientAuthSanEmail(self::TLS_CLIENT_AUTH_SAN_EMAIL)
            ->setTlsClientCertificateBoundAccessTokens(true)
            ->setSelfSignedCertificateKeyId('keyId')
            ->setSoftwareId(self::SOFTWARE_ID)
            ->setSoftwareVersion(self::SOFTWARE_VERSION)
            ->setAuthorizationSignAlg(JWSAlg::HS256)
            ->setAuthorizationEncryptionAlg(JWEAlg::A128KW)
            ->setAuthorizationEncryptionEnc(JWEEnc::A128CBC_HS256)
            ->setBcDeliveryMode(DeliveryMode::POLL)
            ->setBcNotificationEndpoint(self::BC_NOTIFICATION_ENDPOINT)
            ->setBcRequestSignAlg(JWSAlg::ES256)
            ->setBcUserCodeRequired(true)
            ->setDynamicallyRegistered(true)
            ->setRegistrationAccessTokenHash(self::REGISTRATION_ACCESS_TOKEN_HASH)
            ->setAuthorizationDataTypes(
                array(
                    "type-0",
                    "type-1"
                )
            )
            ->setParRequired(true)
            ->setRequestObjectRequired(true);

        return $obj;
    }


    public function testToJson()
    {
        $obj = $this->buildObj();
        $json = $obj->toJson();
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
        $this->assertEquals('CODE', $responseTypes[0]);
        $this->assertEquals('TOKEN', $responseTypes[1]);

        // grantTypes
        $this->assertArrayHasKey('grantTypes', $array);
        $grantTypes = $array['grantTypes'];

        $this->assertTrue(is_array($grantTypes));
        $this->assertCount(2, $grantTypes);
        $this->assertEquals('AUTHORIZATION_CODE', $grantTypes[0]);
        $this->assertEquals('IMPLICIT', $grantTypes[1]);

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
        $this->assertArrayHasKey('tag', $clientName0);
        $this->assertArrayHasKey('value', $clientName0);
        $this->assertEquals('client-name-tag-0', $clientName0['tag']);
        $this->assertEquals('client-name-value-0', $clientName0['value']);

        $clientName1 = $clientNames[1];
        $this->assertTrue(is_array($clientName1));
        $this->assertArrayHasKey('tag', $clientName1);
        $this->assertArrayHasKey('value', $clientName1);
        $this->assertEquals('client-name-tag-1', $clientName1['tag']);
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
        $this->assertArrayHasKey('tag', $logoUri0);
        $this->assertArrayHasKey('value', $logoUri0);
        $this->assertEquals('logo-uri-tag-0', $logoUri0['tag']);
        $this->assertEquals('logo-uri-value-0', $logoUri0['value']);

        $logoUri1 = $logoUris[1];
        $this->assertTrue(is_array($logoUri1));
        $this->assertArrayHasKey('tag', $logoUri1);
        $this->assertArrayHasKey('value', $logoUri1);
        $this->assertEquals('logo-uri-tag-1', $logoUri1['tag']);
        $this->assertEquals('logo-uri-value-1', $logoUri1['value']);

        // clientUri
        $this->assertArrayHasKey('clientUri', $array);
        $this->assertEquals(self::CLIENT_URI, $array['clientUri']);

        // clientUris
        $this->assertArrayHasKey('clientUris', $array);
        $clientUris = $array['clientUris'];

        $this->assertTrue(is_array($clientUris));
        $this->assertCount(2, $clientUris);

        $clientUri0 = $clientUris[0];
        $this->assertTrue(is_array($clientUri0));
        $this->assertArrayHasKey('tag', $clientUri0);
        $this->assertArrayHasKey('value', $clientUri0);
        $this->assertEquals('client-uri-tag-0', $clientUri0['tag']);
        $this->assertEquals('client-uri-value-0', $clientUri0['value']);

        $clientUri1 = $clientUris[1];
        $this->assertTrue(is_array($clientUri1));
        $this->assertArrayHasKey('tag', $clientUri1);
        $this->assertArrayHasKey('value', $clientUri1);
        $this->assertEquals('client-uri-tag-1', $clientUri1['tag']);
        $this->assertEquals('client-uri-value-1', $clientUri1['value']);

        // policyUri
        $this->assertArrayHasKey('policyUri', $array);
        $this->assertEquals(self::POLICY_URI, $array['policyUri']);

        // policyUris
        $this->assertArrayHasKey('policyUris', $array);
        $policyUris = $array['policyUris'];

        $this->assertTrue(is_array($policyUris));
        $this->assertCount(2, $policyUris);

        $policyUri0 = $policyUris[0];
        $this->assertTrue(is_array($policyUri0));
        $this->assertArrayHasKey('tag', $policyUri0);
        $this->assertArrayHasKey('value', $policyUri0);
        $this->assertEquals('policy-uri-tag-0', $policyUri0['tag']);
        $this->assertEquals('policy-uri-value-0', $policyUri0['value']);

        $policyUri1 = $policyUris[1];
        $this->assertTrue(is_array($policyUri1));
        $this->assertArrayHasKey('tag', $policyUri1);
        $this->assertArrayHasKey('value', $policyUri1);
        $this->assertEquals('policy-uri-tag-1', $policyUri1['tag']);
        $this->assertEquals('policy-uri-value-1', $policyUri1['value']);

        // tosUri
        $this->assertArrayHasKey('tosUri', $array);
        $this->assertEquals(self::TOS_URI, $array['tosUri']);

        // tosUris
        $this->assertArrayHasKey('tosUris', $array);
        $tosUris = $array['tosUris'];

        $this->assertTrue(is_array($tosUris));
        $this->assertCount(2, $tosUris);

        $tosUri0 = $tosUris[0];
        $this->assertTrue(is_array($tosUri0));
        $this->assertArrayHasKey('tag', $tosUri0);
        $this->assertArrayHasKey('value', $tosUri0);
        $this->assertEquals('tos-uri-tag-0', $tosUri0['tag']);
        $this->assertEquals('tos-uri-value-0', $tosUri0['value']);

        $tosUri1 = $tosUris[1];
        $this->assertTrue(is_array($tosUri1));
        $this->assertArrayHasKey('tag', $tosUri1);
        $this->assertArrayHasKey('value', $tosUri1);
        $this->assertEquals('tos-uri-tag-1', $tosUri1['tag']);
        $this->assertEquals('tos-uri-value-1', $tosUri1['value']);

        // jwksUri
        $this->assertArrayHasKey('jwksUri', $array);
        $this->assertEquals(self::JWKS_URI, $array['jwksUri']);

        // jwks
        $this->assertArrayHasKey('jwks', $array);
        $this->assertEquals(self::JWKS, $array['jwks']);

        // derivedSectorIdentifier
        $this->assertArrayHasKey('derivedSectorIdentifier', $array);
        $this->assertEquals(self::DERIVED_SECTOR_IDENTIFIER, $array['derivedSectorIdentifier']);

        // sectorIdentifierUri
        $this->assertArrayHasKey('sectorIdentifierUri', $array);
        $this->assertEquals(self::SECTOR_IDENTIFIER_URI, $array['sectorIdentifierUri']);

        // subjectType
        $this->assertArrayHasKey('subjectType', $array);
        $this->assertEquals('PUBLIC', $array['subjectType']);

        // idTokenSignAlg
        $this->assertArrayHasKey('idTokenSignAlg', $array);
        $this->assertEquals('HS256', $array['idTokenSignAlg']);

        // idTokenEncryptionAlg
        $this->assertArrayHasKey('idTokenEncryptionAlg', $array);
        $this->assertEquals('A128KW', $array['idTokenEncryptionAlg']);

        // idTokenEncryptionEnc
        $this->assertArrayHasKey('idTokenEncryptionEnc', $array);
        $this->assertEquals('A128CBC_HS256', $array['idTokenEncryptionEnc']);

        // userInfoSignAlg
        $this->assertArrayHasKey('userInfoSignAlg', $array);
        $this->assertEquals('HS256', $array['userInfoSignAlg']);

        // userInfoEncryptionAlg
        $this->assertArrayHasKey('userInfoEncryptionAlg', $array);
        $this->assertEquals('A128KW', $array['userInfoEncryptionAlg']);

        // userInfoEncryptionEnc
        $this->assertArrayHasKey('userInfoEncryptionEnc', $array);
        $this->assertEquals('A128CBC_HS256', $array['userInfoEncryptionEnc']);

        // requestSignAlg
        $this->assertArrayHasKey('requestSignAlg', $array);
        $this->assertEquals('HS256', $array['requestSignAlg']);

        // requestEncryptionAlg
        $this->assertArrayHasKey('requestEncryptionAlg', $array);
        $this->assertEquals('A128KW', $array['requestEncryptionAlg']);

        // requestEncryptionEnc
        $this->assertArrayHasKey('requestEncryptionEnc', $array);
        $this->assertEquals('A128CBC_HS256', $array['requestEncryptionEnc']);

        // tokenAuthMethod
        $this->assertArrayHasKey('tokenAuthMethod', $array);
        $this->assertEquals('CLIENT_SECRET_POST', $array['tokenAuthMethod']);

        // tokenAuthSignAlg
        $this->assertArrayHasKey('tokenAuthSignAlg', $array);
        $this->assertEquals('HS256', $array['tokenAuthSignAlg']);

        // defaultMaxAge
        $this->assertArrayHasKey('defaultMaxAge', $array);
        $this->assertEquals(self::DEFAULT_MAX_AGE_INT, $array['defaultMaxAge']);

        // authTimeRequired
        $this->assertArrayHasKey('authTimeRequired', $array);
        $this->assertEquals(true, $array['authTimeRequired']);

        // defaultAcrs
        $this->assertArrayHasKey('defaultAcrs', $array);
        $defaultAcrs = $array['defaultAcrs'];

        $this->assertTrue(is_array($defaultAcrs));
        $this->assertCount(2, $defaultAcrs);
        $this->assertEquals("acr-0", $defaultAcrs[0]);
        $this->assertEquals("acr-1", $defaultAcrs[1]);

        // loginUri
        $this->assertArrayHasKey('loginUri', $array);
        $this->assertEquals(self::LOGIN_URI, $array['loginUri']);

        // requestUris
        $this->assertArrayHasKey('requestUris', $array);
        $requestUris = $array['requestUris'];

        $this->assertTrue(is_array($requestUris));
        $this->assertCount(2, $requestUris);
        $this->assertEquals("request_uri-0", $requestUris[0]);
        $this->assertEquals("request_uri-1", $requestUris[1]);

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
        $this->assertArrayHasKey('tag', $description0);
        $this->assertArrayHasKey('value', $description0);
        $this->assertEquals('description-tag-0', $description0['tag']);
        $this->assertEquals('description-value-0', $description0['value']);

        $description1 = $descriptions[1];
        $this->assertTrue(is_array($description1));
        $this->assertArrayHasKey('tag', $description1);
        $this->assertArrayHasKey('value', $description1);
        $this->assertEquals('description-tag-1', $description1['tag']);
        $this->assertEquals('description-value-1', $description1['value']);

        // createdAt
        $this->assertArrayHasKey('createdAt', $array);
        $this->assertEquals(self::CREATED_AT_INT, $array['createdAt']);

        // modifiedAt
        $this->assertArrayHasKey('modifiedAt', $array);
        $this->assertEquals(self::MODIFIED_AT_INT, $array['modifiedAt']);

        // extension
        $this->assertArrayHasKey('extension', $array);
        $extension = $array['extension'];

        $this->assertTrue(is_array($extension));

        $this->assertArrayHasKey('requestableScopesEnabled', $extension);
        $this->assertEquals(true, $extension['requestableScopesEnabled']);

        $this->assertArrayHasKey('requestableScopes', $extension);
        $requestableScopes = $extension['requestableScopes'];

        $this->assertTrue(is_array($requestableScopes));
        $this->assertCount(2, $requestableScopes);
        $this->assertEquals('requestable_scope-0', $requestableScopes[0]);
        $this->assertEquals('requestable_scope-1', $requestableScopes[1]);

        // tlsClientAuthSubjectDn
        $this->assertArrayHasKey('tlsClientAuthSubjectDn', $array);
        $this->assertEquals(self::TLS_CLIENT_AUTH_SUBJECT_DN, $array['tlsClientAuthSubjectDn']);

        // tlsClientAuthSanDns
        $this->assertArrayHasKey('tlsClientAuthSanDns', $array);
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_DNS, $array['tlsClientAuthSanDns']);

        // tlsClientAuthSanUri
        $this->assertArrayHasKey('tlsClientAuthSanUri', $array);
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_URI, $array['tlsClientAuthSanUri']);

        // tlsClientAuthSanIp
        $this->assertArrayHasKey('tlsClientAuthSanIp', $array);
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_IP, $array['tlsClientAuthSanIp']);

        // tlsClientAuthSanEmail
        $this->assertArrayHasKey('tlsClientAuthSanEmail', $array);
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_EMAIL, $array['tlsClientAuthSanEmail']);

        // tlsClientCertificateBoundAccessTokens
        $this->assertArrayHasKey('tlsClientCertificateBoundAccessTokens', $array);
        $this->assertEquals(true, $array['tlsClientCertificateBoundAccessTokens']);

        // selfSignedCertificateKeyId
        $this->assertArrayHasKey('selfSignedCertificateKeyId', $array);
        $this->assertEquals('keyId', $array['selfSignedCertificateKeyId']);

        // softwareId
        $this->assertArrayHasKey('softwareId', $array);
        $this->assertEquals(self::SOFTWARE_ID, $array['softwareId']);

        // softwareVersion
        $this->assertArrayHasKey('softwareVersion', $array);
        $this->assertEquals(self::SOFTWARE_VERSION, $array['softwareVersion']);

        // authorizationSignAlg
        $this->assertArrayHasKey('authorizationSignAlg', $array);
        $this->assertEquals('HS256', $array['authorizationSignAlg']);

        // authorizationEncryptionAlg
        $this->assertArrayHasKey('authorizationEncryptionAlg', $array);
        $this->assertEquals('A128KW', $array['authorizationEncryptionAlg']);

        // authorizationEncryptionEnc
        $this->assertArrayHasKey('authorizationEncryptionEnc', $array);
        $this->assertEquals('A128CBC_HS256', $array['authorizationEncryptionEnc']);

        // bcDeliveryMode
        $this->assertArrayHasKey('bcDeliveryMode', $array);
        $this->assertEquals('POLL', $array['bcDeliveryMode']);

        // bcNotificationEndpoint
        $this->assertArrayHasKey('bcNotificationEndpoint', $array);
        $this->assertEquals(self::BC_NOTIFICATION_ENDPOINT, $array['bcNotificationEndpoint']);

        // bcRequestSignAlg
        $this->assertArrayHasKey('bcRequestSignAlg', $array);
        $this->assertEquals('ES256', $array['bcRequestSignAlg']);

        // bcUserCodeRequired
        $this->assertArrayHasKey('bcUserCodeRequired', $array);
        $this->assertEquals(true, $array['bcUserCodeRequired']);

        // dynamicallyRegistered
        $this->assertArrayHasKey('dynamicallyRegistered', $array);
        $this->assertEquals(true, $array['dynamicallyRegistered']);

        // registrationAccessTokenHash
        $this->assertArrayHasKey('registrationAccessTokenHash', $array);
        $this->assertEquals(self::REGISTRATION_ACCESS_TOKEN_HASH, $array['registrationAccessTokenHash']);

        // authorizationDataTypes
        $this->assertArrayHasKey('authorizationDataTypes', $array);
        $authorizationDataTypes = $array['authorizationDataTypes'];

        $this->assertTrue(is_array($authorizationDataTypes));
        $this->assertCount(2, $authorizationDataTypes);
        $this->assertEquals("type-0", $authorizationDataTypes[0]);
        $this->assertEquals("type-1", $authorizationDataTypes[1]);

        // parRequired
        $this->assertArrayHasKey('parRequired', $array);
        $this->assertEquals(true, $array['parRequired']);

        // requestObjectRequired
        $this->assertArrayHasKey('requestObjectRequired', $array);
        $this->assertEquals(true, $array['requestObjectRequired']);
    }


    public function testGetters()
    {
        $obj = $this->buildObj();

        // developer
        $this->assertEquals(self::DEVELOPER, $obj->getDeveloper());

        // clientId
        $this->assertEquals(self::CLIENT_ID_INT, $obj->getClientId());

        // clientIdAlias
        $this->assertEquals(self::CLIENT_ID_ALIAS, $obj->getClientIdAlias());

        // clientIdAliasEnabled
        $this->assertEquals(true, $obj->isClientIdAliasEnabled());

        // clientSecret
        $this->assertEquals(self::CLIENT_SECRET, $obj->getClientSecret());

        // clientType
        $this->assertSame(ClientType::PUBLIC, $obj->getClientType());

        // redirectUris
        $redirectUris = $obj->getRedirectUris();

        $this->assertTrue(is_array($redirectUris));
        $this->assertCount(2, $redirectUris);
        $this->assertEquals("redirect_uri-0", $redirectUris[0]);
        $this->assertEquals("redirect_uri-1", $redirectUris[1]);

        // responseTypes
        $responseTypes = $obj->getResponseTypes();

        $this->assertTrue(is_array($responseTypes));
        $this->assertCount(2, $responseTypes);
        $this->assertSame(ResponseType::CODE->value, $responseTypes[0]);
        $this->assertSame(ResponseType::TOKEN->value, $responseTypes[1]);

        // grantTypes
        $grantTypes = $obj->getGrantTypes();

        $this->assertTrue(is_array($grantTypes));
        $this->assertCount(2, $grantTypes);
        $this->assertSame(GrantType::AUTHORIZATION_CODE->value, $grantTypes[0]);
        $this->assertSame(GrantType::IMPLICIT->value, $grantTypes[1]);

        // applicationType
        $this->assertSame(ApplicationType::WEB, $obj->getApplicationType());

        // contacts
        $contacts = $obj->getContacts();

        $this->assertTrue(is_array($contacts));
        $this->assertCount(2, $contacts);
        $this->assertEquals("contact-0", $contacts[0]);
        $this->assertEquals("contact-1", $contacts[1]);

        // clientName
        $this->assertEquals(self::CLIENT_NAME, $obj->getClientName());

        // clientNames
        $clientNames = $obj->getClientNames();

        $this->assertTrue(is_array($clientNames));
        $this->assertCount(2, $clientNames);

        $clientName0 = $clientNames[0];
        $this->assertEquals('client-name-tag-0', $clientName0->getTag());
        $this->assertEquals('client-name-value-0', $clientName0->getValue());

        $clientName1 = $clientNames[1];
        $this->assertEquals('client-name-tag-1', $clientName1->getTag());
        $this->assertEquals('client-name-value-1', $clientName1->getValue());

        // logoUri
        $this->assertEquals(self::LOGO_URI, $obj->getLogoUri());

        // logoUris
        $logoUris = $obj->getLogoUris();

        $this->assertTrue(is_array($logoUris));
        $this->assertCount(2, $logoUris);

        $logoUri0 = $logoUris[0];
        $this->assertEquals('logo-uri-tag-0', $logoUri0->getTag());
        $this->assertEquals('logo-uri-value-0', $logoUri0->getValue());

        $logoUri1 = $logoUris[1];
        $this->assertEquals('logo-uri-tag-1', $logoUri1->getTag());
        $this->assertEquals('logo-uri-value-1', $logoUri1->getValue());

        // clientUri
        $this->assertEquals(self::CLIENT_URI, $obj->getClientUri());

        // clientUris
        $clientUris = $obj->getClientUris();

        $this->assertTrue(is_array($clientUris));
        $this->assertCount(2, $clientUris);

        $clientUri0 = $clientUris[0];
        $this->assertEquals('client-uri-tag-0', $clientUri0->getTag());
        $this->assertEquals('client-uri-value-0', $clientUri0->getValue());

        $clientUri1 = $clientUris[1];
        $this->assertEquals('client-uri-tag-1', $clientUri1->getTag());
        $this->assertEquals('client-uri-value-1', $clientUri1->getValue());

        // policyUri
        $this->assertEquals(self::POLICY_URI, $obj->getPolicyUri());

        // policyUris
        $policyUris = $obj->getPolicyUris();

        $this->assertTrue(is_array($policyUris));
        $this->assertCount(2, $policyUris);

        $policyUri0 = $policyUris[0];
        $this->assertEquals('policy-uri-tag-0', $policyUri0->getTag());
        $this->assertEquals('policy-uri-value-0', $policyUri0->getValue());

        $policyUri1 = $policyUris[1];
        $this->assertEquals('policy-uri-tag-1', $policyUri1->getTag());
        $this->assertEquals('policy-uri-value-1', $policyUri1->getValue());

        // tosUri
        $this->assertEquals(self::TOS_URI, $obj->getTosUri());

        // tosUris
        $tosUris = $obj->getTosUris();

        $this->assertTrue(is_array($tosUris));
        $this->assertCount(2, $tosUris);

        $tosUri0 = $tosUris[0];
        $this->assertEquals('tos-uri-tag-0', $tosUri0->getTag());
        $this->assertEquals('tos-uri-value-0', $tosUri0->getValue());

        $tosUri1 = $tosUris[1];
        $this->assertEquals('tos-uri-tag-1', $tosUri1->getTag());
        $this->assertEquals('tos-uri-value-1', $tosUri1->getValue());

        // jwksUri
        $this->assertEquals(self::JWKS_URI, $obj->getJwksUri());

        // jwks
        $this->assertEquals(self::JWKS, $obj->getJwks());

        // derivedSectorIdentifier
        $this->assertEquals(self::DERIVED_SECTOR_IDENTIFIER, $obj->getDerivedSectorIdentifier());

        // sectorIdentifierUri
        $this->assertEquals(self::SECTOR_IDENTIFIER_URI, $obj->getSectorIdentifierUri());

        // subjectType
        $this->assertSame(SubjectType::PUBLIC, $obj->getSubjectType());

        // idTokenSignAlg
        $this->assertSame(JWSAlg::HS256, $obj->getIdTokenSignAlg());

        // idTokenEncryptionAlg
        $this->assertSame(JWEAlg::A128KW, $obj->getIdTokenEncryptionAlg());

        // idTokenEncryptionEnc
        $this->assertSame(JWEEnc::A128CBC_HS256, $obj->getIdTokenEncryptionEnc());

        // userInfoSignAlg
        $this->assertSame(JWSAlg::HS256, $obj->getUserInfoSignAlg());

        // userInfoEncryptionAlg
        $this->assertSame(JWEAlg::A128KW, $obj->getUserInfoEncryptionAlg());

        // userInfoEncryptionEnc
        $this->assertSame(JWEEnc::A128CBC_HS256, $obj->getUserInfoEncryptionEnc());

        // requestSignAlg
        $this->assertSame(JWSAlg::HS256, $obj->getRequestSignAlg());

        // requestEncryptionAlg
        $this->assertSame(JWEAlg::A128KW, $obj->getRequestEncryptionAlg());

        // requestEncryptionEnc
        $this->assertSame(JWEEnc::A128CBC_HS256, $obj->getRequestEncryptionEnc());

        // tokenAuthMethod
        $this->assertSame(ClientAuthMethod::CLIENT_SECRET_POST, $obj->getTokenAuthMethod());

        // tokenAuthSignAlg
        $this->assertSame(JWSAlg::HS256, $obj->getTokenAuthSignAlg());

        // defaultMaxAge
        $this->assertEquals(self::DEFAULT_MAX_AGE_INT, $obj->getDefaultMaxAge());

        // authTimeRequired
        $this->assertEquals(true, $obj->isAuthTimeRequired());

        // defaultAcrs
        $defaultAcrs = $obj->getDefaultAcrs();

        $this->assertTrue(is_array($defaultAcrs));
        $this->assertCount(2, $defaultAcrs);
        $this->assertEquals("acr-0", $defaultAcrs[0]);
        $this->assertEquals("acr-1", $defaultAcrs[1]);

        // loginUri
        $this->assertEquals(self::LOGIN_URI, $obj->getLoginUri());

        // requestUris
        $requestUris = $obj->getRequestUris();

        $this->assertTrue(is_array($requestUris));
        $this->assertCount(2, $requestUris);
        $this->assertEquals("request_uri-0", $requestUris[0]);
        $this->assertEquals("request_uri-1", $requestUris[1]);

        // description
        $this->assertEquals(self::DESCRIPTION, $obj->getDescription());

        // descriptions
        $descriptions = $obj->getDescriptions();

        $this->assertTrue(is_array($descriptions));
        $this->assertCount(2, $descriptions);

        $description0 = $descriptions[0];
        $this->assertEquals('description-tag-0', $description0->getTag());
        $this->assertEquals('description-value-0', $description0->getValue());

        $description1 = $descriptions[1];
        $this->assertEquals('description-tag-1', $description1->getTag());
        $this->assertEquals('description-value-1', $description1->getValue());

        // createdAt
        $this->assertEquals(self::CREATED_AT_INT, $obj->getCreatedAt());

        // modifiedAt
        $this->assertEquals(self::MODIFIED_AT_INT, $obj->getModifiedAt());

        // extension
        $extension = $obj->getExtension();

        $this->assertEquals(true, $extension->isRequestableScopesEnabled());
        $requestableScopes = $extension->getRequestableScopes();

        $this->assertTrue(is_array($requestableScopes));
        $this->assertCount(2, $requestableScopes);
        $this->assertEquals('requestable_scope-0', $requestableScopes[0]);
        $this->assertEquals('requestable_scope-1', $requestableScopes[1]);

        // tlsClientAuthSubjectDn
        $this->assertEquals(self::TLS_CLIENT_AUTH_SUBJECT_DN, $obj->getTlsClientAuthSubjectDn());

        // tlsClientAuthSanDns
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_DNS, $obj->getTlsClientAuthSanDns());

        // tlsClientAuthSanUri
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_URI, $obj->getTlsClientAuthSanUri());

        // tlsClientAuthSanIp
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_IP, $obj->getTlsClientAuthSanIp());

        // tlsClientAuthSanEmail
        $this->assertEquals(self::TLS_CLIENT_AUTH_SAN_EMAIL, $obj->getTlsClientAuthSanEmail());

        // tlsClientCertificateBoundAccessTokens
        $this->assertEquals(true, $obj->isTlsClientCertificateBoundAccessTokens());

        // selfSignedCertificateKeyId
        $this->assertEquals('keyId', $obj->getSelfSignedCertificateKeyId());

        // softwareId
        $this->assertEquals(self::SOFTWARE_ID, $obj->getSoftwareId());

        // softwareVersion
        $this->assertEquals(self::SOFTWARE_VERSION, $obj->getSoftwareVersion());

        // authorizationSignAlg
        $this->assertSame(JWSAlg::HS256, $obj->getAuthorizationSignAlg());

        // authorizationEncryptionAlg
        $this->assertSame(JWEAlg::A128KW, $obj->getAuthorizationEncryptionAlg());

        // authorizationEncryptionEnc
        $this->assertSame(JWEEnc::A128CBC_HS256, $obj->getAuthorizationEncryptionEnc());

        // bcDeliveryMode
        $this->assertSame(DeliveryMode::POLL, $obj->getBcDeliveryMode());

        // bcNotificationEndpoint
        $this->assertEquals(self::BC_NOTIFICATION_ENDPOINT, $obj->getBcNotificationEndpoint());

        // bcRequestSignAlg
        $this->assertSame(JWSAlg::ES256, $obj->getBcRequestSignAlg());

        // bcUserCodeRequired
        $this->assertEquals(true, $obj->isBcUserCodeRequired());

        // dynamicallyRegistered
        $this->assertEquals(true, $obj->isDynamicallyRegistered());

        // registrationAccessTokenHash
        $this->assertEquals(self::REGISTRATION_ACCESS_TOKEN_HASH, $obj->getRegistrationAccessTokenHash());

        // authorizationDataTypes
        $authorizationDataTypes = $obj->getAuthorizationDataTypes();

        $this->assertTrue(is_array($authorizationDataTypes));
        $this->assertCount(2, $authorizationDataTypes);
        $this->assertEquals("type-0", $authorizationDataTypes[0]);
        $this->assertEquals("type-1", $authorizationDataTypes[1]);

        // parRequired
        $this->assertEquals(true, $obj->isParRequired());

        // requestObjectRequired
        $this->assertEquals(true, $obj->isRequestObjectRequired());
    }


    private static function createArrayOfTaggedValue()
    {
        $array = array(
            new TaggedValue('tag0', 'value0'),
            new TaggedValue('tag1', 'value1')
        );

        return $array;
    }


    private function checkArrayOfTaggedValue(array &$tags): void
    {
        $this->assertTrue(is_array($tags));
        $this->assertCount(2, $tags);

        $tag0 = $tags[0];
        $this->assertInstanceOf(TaggedValue::class, $tag0);
        $this->assertEquals('tag0', $tag0->getTag());
        $this->assertEquals('value0', $tag0->getValue());

        $tag1 = $tags[1];
        $this->assertInstanceOf(TaggedValue::class, $tag1);
        $this->assertEquals('tag1', $tag1->getTag());
        $this->assertEquals('value1', $tag1->getValue());
    }
}