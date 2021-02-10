<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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
use Authlete\Dto\NamedUri;
use Authlete\Dto\Scope;
use Authlete\Dto\Service;
use Authlete\Dto\SnsCredentials;
use Authlete\Types\ClaimType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\DeliveryMode;
use Authlete\Types\Display;
use Authlete\Types\GrantType;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\ServiceProfile;
use Authlete\Types\Sns;
use Authlete\Types\UserCodeCharset;


class ServiceTest extends TestCase
{
    public function testServiceNameValidValue()
    {
        $obj = new Service();
        $obj->setServiceName('MyService');

        $this->assertEquals('MyService', $obj->getServiceName());
    }


    public function testServiceNameValidNull()
    {
        $obj = new Service();
        $obj->setServiceName(null);

        $this->assertNull($obj->getServiceName());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testServiceNameInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setServiceName($invalid);
    }


    public function testApiKeyValidInt()
    {
        $obj = new Service();
        $obj->setApiKey(1);

        $this->assertEquals(1, $obj->getApiKey());
    }


    public function testApiKeyValidStr()
    {
        $obj = new Service();
        $obj->setApiKey('2');

        $this->assertEquals('2', $obj->getApiKey());
    }


    public function testApiKeyValidNull()
    {
        $obj = new Service();
        $obj->setApiKey(null);

        $this->assertNull($obj->getApiKey());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testApiKeyInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setApiKey($invalid);
    }


    public function testApiSecretValidValue()
    {
        $obj = new Service();
        $obj->setApiSecret('secret');

        $this->assertEquals('secret', $obj->getApiSecret());
    }


    public function testApiSecretValidNull()
    {
        $obj = new Service();
        $obj->setApiSecret(null);

        $this->assertNull($obj->getApiSecret());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testApiSecretInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setApiSecret($invalid);
    }


    public function testIssuerValidValue()
    {
        $obj = new Service();
        $obj->setIssuer('_issuer_');

        $this->assertEquals('_issuer_', $obj->getIssuer());
    }


    public function testIssuerValidNull()
    {
        $obj = new Service();
        $obj->setIssuer(null);

        $this->assertNull($obj->getIssuer());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testIssuerInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setIssuer($invalid);
    }


    public function testAuthorizationEndpointValidValue()
    {
        $obj = new Service();
        $obj->setAuthorizationEndpoint('endpoint');

        $this->assertEquals('endpoint', $obj->getAuthorizationEndpoint());
    }


    public function testAuthorizationEndpointValidNull()
    {
        $obj = new Service();
        $obj->setAuthorizationEndpoint(null);

        $this->assertNull($obj->getAuthorizationEndpoint());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testAuthorizationEndpointInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setAuthorizationEndpoint($invalid);
    }


    public function testTokenEndpointValidValue()
    {
        $obj = new Service();
        $obj->setTokenEndpoint('endpoint');

        $this->assertEquals('endpoint', $obj->getTokenEndpoint());
    }


    public function testTokenEndpointValidNull()
    {
        $obj = new Service();
        $obj->setTokenEndpoint(null);

        $this->assertNull($obj->getTokenEndpoint());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTokenEndpointInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setTokenEndpoint($invalid);
    }


    public function testRevocationEndpointValidValue()
    {
        $obj = new Service();
        $obj->setRevocationEndpoint('endpoint');

        $this->assertEquals('endpoint', $obj->getRevocationEndpoint());
    }


    public function testRevocationEndpointValidNull()
    {
        $obj = new Service();
        $obj->setRevocationEndpoint(null);

        $this->assertNull($obj->getRevocationEndpoint());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRevocationEndpointInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setRevocationEndpoint($invalid);
    }


    public function testSupportedRevocationAuthMethodsValidValue()
    {
        $obj = new Service();

        $array = array(
            ClientAuthMethod::$CLIENT_SECRET_POST,
            ClientAuthMethod::$CLIENT_SECRET_JWT
        );
        $obj->setSupportedRevocationAuthMethods($array);

        $methods = $obj->getSupportedRevocationAuthMethods();

        $this->assertTrue(is_array($methods));
        $this->assertCount(2, $methods);
        $this->assertSame(ClientAuthMethod::$CLIENT_SECRET_POST, $methods[0]);
        $this->assertSame(ClientAuthMethod::$CLIENT_SECRET_JWT,  $methods[1]);
    }


    public function testSupportedRevocationAuthMethodsValidNull()
    {
        $obj = new Service();
        $obj->setSupportedRevocationAuthMethods(null);

        $this->assertNull($obj->getSupportedRevocationAuthMethods());
    }


    /**
     * @expectedException Error
     */
    public function testSupportedRevocationAuthMethodsInvalidType()
    {
        $obj = new Service();

        $invalid = '__INVALID__';
        $obj->setSupportedRevocationAuthMethods($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSupportedRevocationAuthMethodsInvalidElement()
    {
        $obj = new Service();

        $invalid = array('__INVALID__');
        $obj->setSupportedRevocationAuthMethods($invalid);
    }


    public function testUserInfoEndpointValidValue()
    {
        $obj = new Service();
        $obj->setUserInfoEndpoint('endpoint');

        $this->assertEquals('endpoint', $obj->getUserInfoEndpoint());
    }


    public function testUserInfoEndpointValidNull()
    {
        $obj = new Service();
        $obj->setUserInfoEndpoint(null);

        $this->assertNull($obj->getUserInfoEndpoint());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testUserInfoEndpointInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setUserInfoEndpoint($invalid);
    }


    public function testJwksUriValidValue()
    {
        $obj = new Service();
        $obj->setJwksUri('uri');

        $this->assertEquals('uri', $obj->getJwksUri());
    }


    public function testJwksUriValidNull()
    {
        $obj = new Service();
        $obj->setJwksUri(null);

        $this->assertNull($obj->getJwksUri());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testJwksUriInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setJwksUri($invalid);
    }


    public function testJwksValidValue()
    {
        $obj = new Service();
        $obj->setJwks('_jwks_');

        $this->assertEquals('_jwks_', $obj->getJwks());
    }


    public function testJwksValidNull()
    {
        $obj = new Service();
        $obj->setJwks(null);

        $this->assertNull($obj->getJwks());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testJwksInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setJwks($invalid);
    }


    public function testRegistrationEndpointValidValue()
    {
        $obj = new Service();
        $obj->setRegistrationEndpoint('endpoint');

        $this->assertEquals('endpoint', $obj->getRegistrationEndpoint());
    }


    public function testRegistrationEndpointValidNull()
    {
        $obj = new Service();
        $obj->setRegistrationEndpoint(null);

        $this->assertNull($obj->getRegistrationEndpoint());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRegistrationEndpointInvalidValue()
    {
        $obj = new Service();

        $invalid = array();
        $obj->setRegistrationEndpoint($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = Service::fromJson($json);

        $this->assertInstanceof(Service::class, $obj);
    }


    public function testFromJsonServiceNameValidValue()
    {
        $json = '{"serviceName":"MyService"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('MyService', $obj->getServiceName());
    }


    public function testFromJsonServiceNameValidNull()
    {
        $json = '{"serviceName":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getServiceName());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonServiceNameInvalidBool()
    {
        $json = '{"serviceName":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonServiceNameInvalidNumber()
    {
        $json = '{"serviceName":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonServiceNameInvalidArray()
    {
        $json = '{"serviceName":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonServiceNameInvalidObject()
    {
        $json = '{"serviceName":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonApiKeyValidInt()
    {
        $json = '{"apiKey":1}';
        $obj  = Service::fromJson($json);

        $this->assertEquals(1, $obj->getApiKey());
    }


    public function testFromJsonApiKeyValidStr()
    {
        $json = '{"apiKey":"2"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals("2", $obj->getApiKey());
    }


    public function testFromJsonApiKeyValidNull()
    {
        $json = '{"apiKey":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getApiKey());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiKeyInvalidBool()
    {
        $json = '{"apiKey":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiKeyInvalidArray()
    {
        $json = '{"apiKey":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiKeyInvalidObject()
    {
        $json = '{"apiKey":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonApiSecretValidValue()
    {
        $json = '{"apiSecret":"secret"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('secret', $obj->getApiSecret());
    }


    public function testFromJsonApiSecretValidNull()
    {
        $json = '{"apiSecret":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getApiSecret());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiSecretInvalidBool()
    {
        $json = '{"apiSecret":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiSecretInvalidNumber()
    {
        $json = '{"apiSecret":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiSecretInvalidArray()
    {
        $json = '{"apiSecret":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonApiSecretInvalidObject()
    {
        $json = '{"apiSecret":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonIssuerValidValue()
    {
        $json = '{"issuer":"_issuer_"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('_issuer_', $obj->getIssuer());
    }


    public function testFromJsonIssuerValidNull()
    {
        $json = '{"issuer":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getIssuer());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIssuerInvalidBool()
    {
        $json = '{"issuer":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIssuerInvalidNumber()
    {
        $json = '{"issuer":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIssuerInvalidArray()
    {
        $json = '{"issuer":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonIssuerInvalidObject()
    {
        $json = '{"issuer":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonAuthorizationEndpointValidValue()
    {
        $json = '{"authorizationEndpoint":"endpoint"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('endpoint', $obj->getAuthorizationEndpoint());
    }


    public function testFromJsonAuthorizationEndpointValidNull()
    {
        $json = '{"authorizationEndpoint":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getAuthorizationEndpoint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthorizationEndpointInvalidBool()
    {
        $json = '{"authorizationEndpoint":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthorizationEndpointInvalidNumber()
    {
        $json = '{"authorizationEndpoint":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthorizationEndpointInvalidArray()
    {
        $json = '{"authorizationEndpoint":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAuthorizationEndpointInvalidObject()
    {
        $json = '{"authorizationEndpoint":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonTokenEndpointValidValue()
    {
        $json = '{"tokenEndpoint":"endpoint"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('endpoint', $obj->getTokenEndpoint());
    }


    public function testFromJsonTokenEndpointValidNull()
    {
        $json = '{"tokenEndpoint":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getTokenEndpoint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTokenEndpointInvalidBool()
    {
        $json = '{"tokenEndpoint":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTokenEndpointInvalidNumber()
    {
        $json = '{"tokenEndpoint":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTokenEndpointInvalidArray()
    {
        $json = '{"tokenEndpoint":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTokenEndpointInvalidObject()
    {
        $json = '{"tokenEndpoint":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonRevocationEndpointValidValue()
    {
        $json = '{"revocationEndpoint":"endpoint"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('endpoint', $obj->getRevocationEndpoint());
    }


    public function testFromJsonRevocationEndpointValidNull()
    {
        $json = '{"revocationEndpoint":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getRevocationEndpoint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRevocationEndpointInvalidBool()
    {
        $json = '{"revocationEndpoint":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRevocationEndpointInvalidNumber()
    {
        $json = '{"revocationEndpoint":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRevocationEndpointInvalidArray()
    {
        $json = '{"revocationEndpoint":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRevocationEndpointInvalidObject()
    {
        $json = '{"revocationEndpoint":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonSupportedRevocationAuthMethodsValidValue()
    {
        $json = '{"supportedRevocationAuthMethods":["CLIENT_SECRET_POST","CLIENT_SECRET_JWT"]}';
        $obj  = Service::fromJson($json);

        $methods = $obj->getSupportedRevocationAuthMethods();

        $this->assertTrue(is_array($methods));
        $this->assertCount(2, $methods);
        $this->assertEquals(ClientAuthMethod::$CLIENT_SECRET_POST, $methods[0]);
        $this->assertEquals(ClientAuthMethod::$CLIENT_SECRET_JWT,  $methods[1]);
    }


    public function testFromJsonSupportedRevocationAuthMethodsValidNull()
    {
        $json = '{"supportedRevocationAuthMethods":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getSupportedRevocationAuthMethods());
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthMethodsInvalidBool()
    {
        $json = '{"supportedRevocationAuthMethods":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthMethodsInvalidNumber()
    {
        $json = '{"supportedRevocationAuthMethods":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthMethodsInvalidString()
    {
        $json = '{"supportedRevocationAuthMethods":"__INVALID__"}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSupportedRevocationAuthMethodsInvalidElement()
    {
        $json = '{"supportedRevocationAuthMethods":["__INVALID__"]}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonUserInfoEndpointValidValue()
    {
        $json = '{"userInfoEndpoint":"endpoint"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('endpoint', $obj->getUserInfoEndpoint());
    }


    public function testFromJsonUserInfoEndpointValidNull()
    {
        $json = '{"userInfoEndpoint":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getUserInfoEndpoint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEndpointInvalidBool()
    {
        $json = '{"userInfoEndpoint":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEndpointInvalidNumber()
    {
        $json = '{"userInfoEndpoint":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEndpointInvalidArray()
    {
        $json = '{"userInfoEndpoint":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonUserInfoEndpointInvalidObject()
    {
        $json = '{"userInfoEndpoint":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonJwksUriValidValue()
    {
        $json = '{"jwksUri":"uri"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('uri', $obj->getJwksUri());
    }


    public function testFromJsonJwksUriValidNull()
    {
        $json = '{"jwksUri":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getJwksUri());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidBool()
    {
        $json = '{"jwksUri":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidNumber()
    {
        $json = '{"jwksUri":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidArray()
    {
        $json = '{"jwksUri":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksUriInvalidObject()
    {
        $json = '{"jwksUri":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonJwksValidValue()
    {
        $json = '{"jwks":"_jwks_"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('_jwks_', $obj->getJwks());
    }


    public function testFromJsonJwksValidNull()
    {
        $json = '{"jwks":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getJwks());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidBool()
    {
        $json = '{"jwks":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidNumber()
    {
        $json = '{"jwks":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidArray()
    {
        $json = '{"jwks":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonJwksInvalidObject()
    {
        $json = '{"jwks":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    public function testFromJsonRegistrationEndpointValidValue()
    {
        $json = '{"registrationEndpoint":"endpoint"}';
        $obj  = Service::fromJson($json);

        $this->assertEquals('endpoint', $obj->getRegistrationEndpoint());
    }


    public function testFromJsonRegistrationEndpointValidNull()
    {
        $json = '{"registrationEndpoint":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getRegistrationEndpoint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegistrationEndpointInvalidBool()
    {
        $json = '{"registrationEndpoint":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegistrationEndpointInvalidNumber()
    {
        $json = '{"registrationEndpoint":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegistrationEndpointInvalidArray()
    {
        $json = '{"registrationEndpoint":["a","b"]}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegistrationEndpointInvalidObject()
    {
        $json = '{"registrationEndpoint":{"a":"b"}}';
        $obj  = Service::fromJson($json);
    }


    private function buildService()
    {
        $obj = new Service();
        $obj->setServiceName('MyService')
            ->setApiKey(1)
            ->setApiSecret('secret')
            ->setIssuer('_issuer_')
            ->setAuthorizationEndpoint('_authorization_endpoint_')
            ->setTokenEndpoint('_token_endpoint_')
            ->setRevocationEndpoint('_revocation_endpoint_')
            ->setSupportedRevocationAuthMethods(
                array(
                    ClientAuthMethod::$CLIENT_SECRET_POST,
                    ClientAuthMethod::$CLIENT_SECRET_JWT
                )
            )
            ->setUserInfoEndpoint('_userinfo_endpoint_')
            ->setJwksUri('_jwks_uri_')
            ->setJwks('_jwks_')
            ->setRegistrationEndpoint('_registration_endpoint_')
            ->setRegistrationManagementEndpoint('_registration_management_endpoint_')
            ->setSupportedScopes(
                array(
                    (new Scope())->setName('scope-0'),
                    (new Scope())->setName('scope-1')
                )
            )
            ->setSupportedResponseTypes(
                array(
                    ResponseType::$CODE,
                    ResponseType::$TOKEN
                )
            )
            ->setSupportedGrantTypes(
                array(
                    GrantType::$AUTHORIZATION_CODE,
                    GrantType::$IMPLICIT
                )
            )
            ->setSupportedAcrs(
                array(
                    "acr-0",
                    "acr-1"
                )
            )
            ->setSupportedTokenAuthMethods(
                array(
                    ClientAuthMethod::$PRIVATE_KEY_JWT,
                    ClientAuthMethod::$TLS_CLIENT_AUTH
                )
            )
            ->setSupportedDisplays(
                array(
                    Display::$PAGE,
                    Display::$POPUP
                )
            )
            ->setSupportedClaimTypes(
                array(
                    ClaimType::$NORMAL,
                    ClaimType::$AGGREGATED
                )
            )
            ->setSupportedClaims(
                array(
                    "claim-0",
                    "claim-1"
                )
            )
            ->setServiceDocumentation('_service_documentation_')
            ->setSupportedClaimLocales(
                array(
                    "claim-locale-0",
                    "claim-locale-1"
                )
            )
            ->setSupportedUiLocales(
                array(
                    "ui-locale-0",
                    "ui-locale-1"
                )
            )
            ->setPolicyUri('_policy_uri_')
            ->setTosUri('_tos_uri_')
            ->setAuthenticationCallbackEndpoint('_authentication_callback_endpoint_')
            ->setAuthenticationCallbackApiKey('_authentication_callback_api_key_')
            ->setAuthenticationCallbackApiSecret('_authentication_callback_api_secret_')
            ->setSupportedSnses(
                array(
                    Sns::$FACEBOOK
                )
            )
            ->setSnsCredentials(
                array(
                    (new SnsCredentials())
                        ->setSns(Sns::$FACEBOOK)
                        ->setApiKey('_sns_api_key_')
                        ->setApiSecret('_sns_api_secret_')
                )
            )
            ->setCreatedAt(12345)
            ->setModifiedAt(67890)
            ->setDeveloperAuthenticationCallbackEndpoint('_developer_authentication_callback_endpoint_')
            ->setDeveloperAuthenticationCallbackApiKey('_developer_authentication_callback_api_key_')
            ->setDeveloperAuthenticationCallbackApiSecret('_developer_authentication_callback_api_secret_')
            ->setSupportedDeveloperSnses(
                array(
                    Sns::$FACEBOOK
                )
            )
            ->setDeveloperSnsCredentials(
                array(
                    (new SnsCredentials())
                        ->setSns(Sns::$FACEBOOK)
                        ->setApiKey('_developer_sns_api_key_')
                        ->setApiSecret('_developer_sns_api_secret_')
                )
            )
            ->setClientsPerDeveloper(10)
            ->setDirectAuthorizationEndpointEnabled(true)
            ->setDirectTokenEndpointEnabled(true)
            ->setDirectRevocationEndpointEnabled(true)
            ->setDirectUserInfoEndpointEnabled(true)
            ->setDirectJwksEndpointEnabled(true)
            ->setDirectIntrospectionEndpointEnabled(true)
            ->setSingleAccessTokenPerSubject(true)
            ->setPkceRequired(true)
            ->setPkceS256Required(true)
            ->setRefreshTokenKept(true)
            ->setRefreshTokenDurationKept(true)
            ->setErrorDescriptionOmitted(true)
            ->setErrorUriOmitted(true)
            ->setClientIdAliasEnabled(true)
            ->setSupportedServiceProfiles(
                array(
                    ServiceProfile::$FAPI,
                    ServiceProfile::$OPEN_BANKING
                )
            )
            ->setTlsClientCertificateBoundAccessTokens(true)
            ->setIntrospectionEndpoint('_introspection_endpoint_')
            ->setSupportedIntrospectionAuthMethods(
                array(
                    ClientAuthMethod::$TLS_CLIENT_AUTH,
                    ClientAuthMethod::$SELF_SIGNED_TLS_CLIENT_AUTH
                )
            )
            ->setMutualTlsValidatePkiCertChain(true)
            ->setTrustedRootCertificates(
                array(
                    "root-certificate-0",
                    "root-certificate-1"
                )
            )
            ->setDynamicRegistrationSupported(true)
            ->setEndSessionEndpoint('_end_session_endpoint_')
            ->setDescription('_description_')
            ->setAccessTokenType('Bearer')
            ->setAccessTokenSignAlg(JWSAlg::$ES256)
            ->setAccessTokenDuration(1234)
            ->setRefreshTokenDuration(5678)
            ->setIdTokenDuration(9012)
            ->setAuthorizationResponseDuration(1111)
            ->setPushedAuthReqDuration(2222)
            ->setAccessTokenSignatureKeyId('access_token_signature_key_id')
            ->setAuthorizationSignatureKeyId('authorization_signature_key_id')
            ->setIdTokenSignatureKeyId('id_token_signature_key_id')
            ->setUserInfoSignatureKeyId('userinfo_signature_key_id')
            ->setSupportedBackchannelTokenDeliveryModes(
                array(
                    DeliveryMode::$POLL,
                    DeliveryMode::$PING,
                    DeliveryMode::$PUSH
                )
            )
            ->setBackchannelAuthenticationEndpoint('_backchannel_authentication_endpoint_')
            ->setBackchannelUserCodeParameterSupported(true)
            ->setBackchannelAuthReqIdDuration(3333)
            ->setBackchannelPollingInterval(4444)
            ->setBackchannelBindingMessageRequiredInFapi(true)
            ->setAllowableClockSkew(60)
            ->setDeviceAuthorizationEndpoint('_device_authorization_endpoint_')
            ->setDeviceVerificationUri('_device_verification_uri_')
            ->setDeviceVerificationUriComplete('_device_verification_uri_complete_')
            ->setDeviceFlowCodeDuration(5555)
            ->setDeviceFlowPollingInterval(6666)
            ->setUserCodeCharset(UserCodeCharset::$BASE20)
            ->setUserCodeLength(10)
            ->setPushedAuthReqEndpoint('_pushed_auth_req_endpoint_')
            ->setMtlsEndpointAliases(
                array(
                    (new NamedUri('name-0', 'uri-0')),
                    (new NamedUri('name-1', 'uri-1'))
                )
            )
            ->setSupportedAuthorizationDataTypes(
                array(
                    "type-0",
                    "type-1"
                )
            )
            ->setSupportedTrustFrameworks(
                array(
                    "framework-0",
                    "framework-1"
                )
            )
            ->setSupportedEvidence(
                array(
                    "evidence-0",
                    "evidence-1"
                )
            )
            ->setSupportedIdentityDocuments(
                array(
                    "document-0",
                    "document-1"
                )
            )
            ->setSupportedVerificationMethods(
                array(
                    "method-0",
                    "method-1"
                )
            )
            ->setSupportedVerifiedClaims(
                array(
                    "claim-0",
                    "claim-1"
                )
            )
            ->setMissingClientIdAllowed(true)
            ->setParRequired(true)
            ->setRequestObjectRequired(true)
            ->setTraditionalRequestObjectProcessingApplied(true)
            ->setClaimShortcutRestrictive(true)
            ->setScopeRequired(true)
            ->setNbfOptional(true)
            ;

        return $obj;
    }


    public function testToJson()
    {
        $obj   = $this->buildService();
        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // serviceName
        $this->assertArrayHasKey('serviceName', $array);
        $this->assertEquals('MyService', $array['serviceName']);

        // apiKey
        $this->assertArrayHasKey('apiKey', $array);
        $this->assertEquals(1, $array['apiKey']);

        // apiSecret
        $this->assertArrayHasKey('apiSecret', $array);
        $this->assertEquals('secret', $array['apiSecret']);

        // issuer
        $this->assertArrayHasKey('issuer', $array);
        $this->assertEquals('_issuer_', $array['issuer']);

        // authorizationEndpoint
        $this->assertArrayHasKey('authorizationEndpoint', $array);
        $this->assertEquals('_authorization_endpoint_', $array['authorizationEndpoint']);

        // tokenEndpoint
        $this->assertArrayHasKey('tokenEndpoint', $array);
        $this->assertEquals('_token_endpoint_', $array['tokenEndpoint']);

        // revocationEndpoint
        $this->assertArrayHasKey('revocationEndpoint', $array);
        $this->assertEquals('_revocation_endpoint_', $array['revocationEndpoint']);

        // supportedRevocationAuthMethods
        $this->assertArrayHasKey('supportedRevocationAuthMethods', $array);
        $revocationAuthMethods = $array['supportedRevocationAuthMethods'];

        $this->assertTrue(is_array($revocationAuthMethods));
        $this->assertCount(2, $revocationAuthMethods);
        $this->assertEquals('CLIENT_SECRET_POST', $revocationAuthMethods[0]);
        $this->assertEquals('CLIENT_SECRET_JWT',  $revocationAuthMethods[1]);

        // userInfoEndpoint
        $this->assertArrayHasKey('userInfoEndpoint', $array);
        $this->assertEquals('_userinfo_endpoint_', $array['userInfoEndpoint']);

        // jwksUri
        $this->assertArrayHasKey('jwksUri', $array);
        $this->assertEquals('_jwks_uri_', $array['jwksUri']);

        // jwks
        $this->assertArrayHasKey('jwks', $array);
        $this->assertEquals('_jwks_', $array['jwks']);

        // registrationEndpoint
        $this->assertArrayHasKey('registrationEndpoint', $array);
        $this->assertEquals('_registration_endpoint_', $array['registrationEndpoint']);

        // registrationManagementEndpoint
        $this->assertArrayHasKey('registrationManagementEndpoint', $array);
        $this->assertEquals('_registration_management_endpoint_', $array['registrationManagementEndpoint']);

        // supportedScopes
        $this->assertArrayHasKey('supportedScopes', $array);
        $scopes = $array['supportedScopes'];

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        $scope0 = $scopes[0];
        $this->assertTrue(is_array($scope0));
        $this->assertArrayHasKey('name', $scope0);
        $this->assertEquals('scope-0', $scope0['name']);

        $scope1 = $scopes[1];
        $this->assertTrue(is_array($scope1));
        $this->assertArrayHasKey('name', $scope1);
        $this->assertEquals('scope-1', $scope1['name']);

        // supportedResponseTypes
        $this->assertArrayHasKey('supportedResponseTypes', $array);
        $responseTypes = $array['supportedResponseTypes'];

        $this->assertTrue(is_array($responseTypes));
        $this->assertCount(2, $responseTypes);
        $this->assertEquals('CODE',  $responseTypes[0]);
        $this->assertEquals('TOKEN', $responseTypes[1]);

        // supportedGrantTypes
        $this->assertArrayHasKey('supportedGrantTypes', $array);
        $grantTypes = $array['supportedGrantTypes'];

        $this->assertTrue(is_array($grantTypes));
        $this->assertCount(2, $grantTypes);
        $this->assertEquals('AUTHORIZATION_CODE', $grantTypes[0]);
        $this->assertEquals('IMPLICIT',           $grantTypes[1]);

        // supportedAcrs
        $this->assertArrayHasKey('supportedAcrs', $array);
        $acrs = $array['supportedAcrs'];

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // supportedTokenAuthMethods
        $this->assertArrayHasKey('supportedTokenAuthMethods', $array);
        $tokenAuthMethods = $array['supportedTokenAuthMethods'];

        $this->assertTrue(is_array($tokenAuthMethods));
        $this->assertCount(2, $tokenAuthMethods);
        $this->assertEquals('PRIVATE_KEY_JWT', $tokenAuthMethods[0]);
        $this->assertEquals('TLS_CLIENT_AUTH', $tokenAuthMethods[1]);

        // supportedDisplays
        $this->assertArrayHasKey('supportedDisplays', $array);
        $displays = $array['supportedDisplays'];

        $this->assertTrue(is_array($displays));
        $this->assertCount(2, $displays);
        $this->assertEquals('PAGE',  $displays[0]);
        $this->assertEquals('POPUP', $displays[1]);

        // supportedClaimTypes
        $this->assertArrayHasKey('supportedClaimTypes', $array);
        $claimTypes = $array['supportedClaimTypes'];

        $this->assertTrue(is_array($claimTypes));
        $this->assertCount(2, $claimTypes);
        $this->assertEquals('NORMAL',     $claimTypes[0]);
        $this->assertEquals('AGGREGATED', $claimTypes[1]);

        // supportedClaims
        $this->assertArrayHasKey('supportedClaims', $array);
        $claims = $array['supportedClaims'];

        $this->assertTrue(is_array($claims));
        $this->assertCount(2, $claims);
        $this->assertEquals('claim-0', $claims[0]);
        $this->assertEquals('claim-1', $claims[1]);

        // serviceDocumentation
        $this->assertArrayHasKey('serviceDocumentation', $array);
        $this->assertEquals('_service_documentation_', $array['serviceDocumentation']);

        // supportedClaimLocales
        $this->assertArrayHasKey('supportedClaimLocales', $array);
        $claimLocales = $array['supportedClaimLocales'];

        $this->assertTrue(is_array($claimLocales));
        $this->assertCount(2, $claimLocales);
        $this->assertEquals('claim-locale-0', $claimLocales[0]);
        $this->assertEquals('claim-locale-1', $claimLocales[1]);

        // supportedUiLocales
        $this->assertArrayHasKey('supportedUiLocales', $array);
        $uiLocales = $array['supportedUiLocales'];

        $this->assertTrue(is_array($uiLocales));
        $this->assertCount(2, $uiLocales);
        $this->assertEquals('ui-locale-0', $uiLocales[0]);
        $this->assertEquals('ui-locale-1', $uiLocales[1]);

        // policyUri
        $this->assertArrayHasKey('policyUri', $array);
        $this->assertEquals('_policy_uri_', $array['policyUri']);

        // tosUri
        $this->assertArrayHasKey('tosUri', $array);
        $this->assertEquals('_tos_uri_', $array['tosUri']);

        // authenticationCallbackEndpoint
        $this->assertArrayHasKey('authenticationCallbackEndpoint', $array);
        $this->assertEquals('_authentication_callback_endpoint_', $array['authenticationCallbackEndpoint']);

        // authenticationCallbackApiKey
        $this->assertArrayHasKey('authenticationCallbackApiKey', $array);
        $this->assertEquals('_authentication_callback_api_key_', $array['authenticationCallbackApiKey']);

        // authenticationCallbackApiSecret
        $this->assertArrayHasKey('authenticationCallbackApiSecret', $array);
        $this->assertEquals('_authentication_callback_api_secret_', $array['authenticationCallbackApiSecret']);

        // supportedSnses
        $this->assertArrayHasKey('supportedSnses', $array);
        $snses = $array['supportedSnses'];

        $this->assertTrue(is_array($snses));
        $this->assertCount(1, $snses);
        $this->assertEquals('FACEBOOK', $snses[0]);

        // snsCredentials
        $this->assertArrayHasKey('snsCredentials', $array);
        $snsCredentials = $array['snsCredentials'];

        $this->assertTrue(is_array($snsCredentials));
        $this->assertCount(1, $snsCredentials);

        $snsCredentials0 = $snsCredentials[0];
        $this->assertTrue(is_array($snsCredentials0));
        $this->assertArrayHasKey('sns', $snsCredentials0);
        $this->assertEquals('FACEBOOK', $snsCredentials0['sns']);
        $this->assertArrayHasKey('apiKey', $snsCredentials0);
        $this->assertEquals('_sns_api_key_', $snsCredentials0['apiKey']);
        $this->assertArrayHasKey('apiSecret', $snsCredentials0);
        $this->assertEquals('_sns_api_secret_', $snsCredentials0['apiSecret']);

        // createdAt
        $this->assertArrayHasKey('createdAt', $array);
        $this->assertEquals(12345, $array['createdAt']);

        // modifiedAt
        $this->assertArrayHasKey('modifiedAt', $array);
        $this->assertEquals(67890, $array['modifiedAt']);

        // developerAuthenticationCallbackEndpoint
        $this->assertArrayHasKey('developerAuthenticationCallbackEndpoint', $array);
        $this->assertEquals('_developer_authentication_callback_endpoint_', $array['developerAuthenticationCallbackEndpoint']);

        // developerAuthenticationCallbackApiKey
        $this->assertArrayHasKey('developerAuthenticationCallbackApiKey', $array);
        $this->assertEquals('_developer_authentication_callback_api_key_', $array['developerAuthenticationCallbackApiKey']);

        // developerAuthenticationCallbackApiSecret
        $this->assertArrayHasKey('developerAuthenticationCallbackApiSecret', $array);
        $this->assertEquals('_developer_authentication_callback_api_secret_', $array['developerAuthenticationCallbackApiSecret']);

        // supportedDeveloperSnses
        $this->assertArrayHasKey('supportedDeveloperSnses', $array);
        $developerSnses = $array['supportedDeveloperSnses'];

        $this->assertTrue(is_array($developerSnses));
        $this->assertCount(1, $developerSnses);
        $this->assertEquals('FACEBOOK', $developerSnses[0]);

        // developerSnsCredentials
        $this->assertArrayHasKey('developerSnsCredentials', $array);
        $developerSnsCredentials = $array['developerSnsCredentials'];

        $this->assertTrue(is_array($developerSnsCredentials));
        $this->assertCount(1, $developerSnsCredentials);

        $developerSnsCredentials0 = $developerSnsCredentials[0];
        $this->assertTrue(is_array($developerSnsCredentials0));
        $this->assertArrayHasKey('sns', $developerSnsCredentials0);
        $this->assertEquals('FACEBOOK', $developerSnsCredentials0['sns']);
        $this->assertArrayHasKey('apiKey', $developerSnsCredentials0);
        $this->assertEquals('_developer_sns_api_key_', $developerSnsCredentials0['apiKey']);
        $this->assertArrayHasKey('apiSecret', $developerSnsCredentials0);
        $this->assertEquals('_developer_sns_api_secret_', $developerSnsCredentials0['apiSecret']);

        // clientsPerDeveloper
        $this->assertArrayHasKey('clientsPerDeveloper', $array);
        $this->assertEquals(10, $array['clientsPerDeveloper']);

        // directAuthorizationEndpointEnabled
        $this->assertArrayHasKey('directAuthorizationEndpointEnabled', $array);
        $this->assertTrue($array['directAuthorizationEndpointEnabled']);

        // directTokenEndpointEnabled
        $this->assertArrayHasKey('directTokenEndpointEnabled', $array);
        $this->assertTrue($array['directTokenEndpointEnabled']);

        // directRevocationEndpointEnabled
        $this->assertArrayHasKey('directRevocationEndpointEnabled', $array);
        $this->assertTrue($array['directRevocationEndpointEnabled']);

        // directUserInfoEndpointEnabled
        $this->assertArrayHasKey('directUserInfoEndpointEnabled', $array);
        $this->assertTrue($array['directUserInfoEndpointEnabled']);

        // directJwksEndpointEnabled
        $this->assertArrayHasKey('directJwksEndpointEnabled', $array);
        $this->assertTrue($array['directJwksEndpointEnabled']);

        // directIntrospectionEndpointEnabled
        $this->assertArrayHasKey('directIntrospectionEndpointEnabled', $array);
        $this->assertTrue($array['directIntrospectionEndpointEnabled']);

        // singleAccessTokenPerSubject
        $this->assertArrayHasKey('singleAccessTokenPerSubject', $array);
        $this->assertTrue($array['singleAccessTokenPerSubject']);

        // pkceRequired
        $this->assertArrayHasKey('pkceRequired', $array);
        $this->assertTrue($array['pkceRequired']);

        // pkceS256Required
        $this->assertArrayHasKey('pkceS256Required', $array);
        $this->assertTrue($array['pkceS256Required']);

        // refreshTokenKept
        $this->assertArrayHasKey('refreshTokenKept', $array);
        $this->assertTrue($array['refreshTokenKept']);

        // refreshTokenDurationKept
        $this->assertArrayHasKey('refreshTokenDurationKept', $array);
        $this->assertTrue($array['refreshTokenDurationKept']);

        // errorDescriptionOmitted
        $this->assertArrayHasKey('errorDescriptionOmitted', $array);
        $this->assertTrue($array['errorDescriptionOmitted']);

        // errorUriOmitted
        $this->assertArrayHasKey('errorUriOmitted', $array);
        $this->assertTrue($array['errorUriOmitted']);

        // clientIdAliasEnabled
        $this->assertArrayHasKey('clientIdAliasEnabled', $array);
        $this->assertTrue($array['clientIdAliasEnabled']);

        // supportedServiceProfiles
        $this->assertArrayHasKey('supportedServiceProfiles', $array);
        $serviceProfiles = $array['supportedServiceProfiles'];

        $this->assertTrue(is_array($serviceProfiles));
        $this->assertCount(2, $serviceProfiles);
        $this->assertEquals('FAPI', $serviceProfiles[0]);
        $this->assertEquals('OPEN_BANKING', $serviceProfiles[1]);

        // tlsClientCertificateBoundAccessTokens
        $this->assertArrayHasKey('tlsClientCertificateBoundAccessTokens', $array);
        $this->assertTrue($array['tlsClientCertificateBoundAccessTokens']);

        // introspectionEndpoint
        $this->assertArrayHasKey('introspectionEndpoint', $array);
        $this->assertEquals('_introspection_endpoint_', $array['introspectionEndpoint']);

        // supportedIntrospectionAuthMethods
        $this->assertArrayHasKey('supportedIntrospectionAuthMethods', $array);
        $introspectionAuthMethods = $array['supportedIntrospectionAuthMethods'];

        $this->assertTrue(is_array($introspectionAuthMethods));
        $this->assertCount(2, $introspectionAuthMethods);
        $this->assertEquals('TLS_CLIENT_AUTH',             $introspectionAuthMethods[0]);
        $this->assertEquals('SELF_SIGNED_TLS_CLIENT_AUTH', $introspectionAuthMethods[1]);

        // mutualTlsValidatePkiCertChain
        $this->assertArrayHasKey('mutualTlsValidatePkiCertChain', $array);
        $this->assertTrue($array['mutualTlsValidatePkiCertChain']);

        // trustedRootCertificates
        $this->assertArrayHasKey('trustedRootCertificates', $array);
        $rootCertificates = $array['trustedRootCertificates'];

        $this->assertTrue(is_array($rootCertificates));
        $this->assertCount(2, $rootCertificates);
        $this->assertEquals('root-certificate-0', $rootCertificates[0]);
        $this->assertEquals('root-certificate-1', $rootCertificates[1]);

        // dynamicRegistrationSupported
        $this->assertArrayHasKey('dynamicRegistrationSupported', $array);
        $this->assertTrue($array['dynamicRegistrationSupported']);

        // endSessionEndpoint
        $this->assertArrayHasKey('endSessionEndpoint', $array);
        $this->assertEquals('_end_session_endpoint_', $array['endSessionEndpoint']);

        // description
        $this->assertArrayHasKey('description', $array);
        $this->assertEquals('_description_', $array['description']);

        // accessTokenType
        $this->assertArrayHasKey('accessTokenType', $array);
        $this->assertEquals('Bearer', $array['accessTokenType']);

        // accessTokenSignAlg
        $this->assertArrayHasKey('accessTokenSignAlg', $array);
        $this->assertEquals('ES256', $array['accessTokenSignAlg']);

        // accessTokenDuration
        $this->assertArrayHasKey('accessTokenDuration', $array);
        $this->assertEquals(1234, $array['accessTokenDuration']);

        // refreshTokenDuration
        $this->assertArrayHasKey('refreshTokenDuration', $array);
        $this->assertEquals(5678, $array['refreshTokenDuration']);

        // idTokenDuration
        $this->assertArrayHasKey('idTokenDuration', $array);
        $this->assertEquals(9012, $array['idTokenDuration']);

        // authorizationResponseDuration
        $this->assertArrayHasKey('authorizationResponseDuration', $array);
        $this->assertEquals(1111, $array['authorizationResponseDuration']);

        // pushedAuthReqDuration
        $this->assertArrayHasKey('pushedAuthReqDuration', $array);
        $this->assertEquals(2222, $array['pushedAuthReqDuration']);

        // accessTokenSignatureKeyId
        $this->assertArrayHasKey('accessTokenSignatureKeyId', $array);
        $this->assertEquals('access_token_signature_key_id', $array['accessTokenSignatureKeyId']);

        // authorizationSignatureKeyId
        $this->assertArrayHasKey('authorizationSignatureKeyId', $array);
        $this->assertEquals('authorization_signature_key_id', $array['authorizationSignatureKeyId']);

        // idTokenSignatureKeyId
        $this->assertArrayHasKey('idTokenSignatureKeyId', $array);
        $this->assertEquals('id_token_signature_key_id', $array['idTokenSignatureKeyId']);

        // userInfoSignatureKeyId
        $this->assertArrayHasKey('userInfoSignatureKeyId', $array);
        $this->assertEquals('userinfo_signature_key_id', $array['userInfoSignatureKeyId']);

        // supportedBackchannelTokenDeliveryModes
        $this->assertArrayHasKey('supportedBackchannelTokenDeliveryModes', $array);
        $deliveryModes = $array['supportedBackchannelTokenDeliveryModes'];

        $this->assertTrue(is_array($deliveryModes));
        $this->assertCount(3, $deliveryModes);
        $this->assertEquals('POLL', $deliveryModes[0]);
        $this->assertEquals('PING', $deliveryModes[1]);
        $this->assertEquals('PUSH', $deliveryModes[2]);

        // backchannelAuthenticationEndpoint
        $this->assertArrayHasKey('backchannelAuthenticationEndpoint', $array);
        $this->assertEquals('_backchannel_authentication_endpoint_', $array['backchannelAuthenticationEndpoint']);

        // backchannelUserCodeParameterSupported
        $this->assertArrayHasKey('backchannelUserCodeParameterSupported', $array);
        $this->assertTrue($array['backchannelUserCodeParameterSupported']);

        // backchannelAuthReqIdDuration
        $this->assertArrayHasKey('backchannelAuthReqIdDuration', $array);
        $this->assertEquals(3333, $array['backchannelAuthReqIdDuration']);

        // backchannelPollingInterval
        $this->assertArrayHasKey('backchannelPollingInterval', $array);
        $this->assertEquals(4444, $array['backchannelPollingInterval']);

        // backchannelBindingMessageRequiredInFapi
        $this->assertArrayHasKey('backchannelBindingMessageRequiredInFapi', $array);
        $this->assertTrue($array['backchannelBindingMessageRequiredInFapi']);

        // allowableClockSkew
        $this->assertArrayHasKey('allowableClockSkew', $array);
        $this->assertEquals(60, $array['allowableClockSkew']);

        // deviceAuthorizationEndpoint
        $this->assertArrayHasKey('deviceAuthorizationEndpoint', $array);
        $this->assertEquals('_device_authorization_endpoint_', $array['deviceAuthorizationEndpoint']);

        // deviceVerificationUri
        $this->assertArrayHasKey('deviceVerificationUri', $array);
        $this->assertEquals('_device_verification_uri_', $array['deviceVerificationUri']);

        // deviceVerificationUriComplete
        $this->assertArrayHasKey('deviceVerificationUriComplete', $array);
        $this->assertEquals('_device_verification_uri_complete_', $array['deviceVerificationUriComplete']);

        // deviceFlowCodeDuration
        $this->assertArrayHasKey('deviceFlowCodeDuration', $array);
        $this->assertEquals(5555, $array['deviceFlowCodeDuration']);

        // deviceFlowPollingInterval
        $this->assertArrayHasKey('deviceFlowPollingInterval', $array);
        $this->assertEquals(6666, $array['deviceFlowPollingInterval']);

        // userCodeCharset
        $this->assertArrayHasKey('userCodeCharset', $array);
        $this->assertEquals('BASE20', $array['userCodeCharset']);

        // userCodeLength
        $this->assertArrayHasKey('userCodeLength', $array);
        $this->assertEquals(10, $array['userCodeLength']);

        // pushedAuthReqEndpoint
        $this->assertArrayHasKey('pushedAuthReqEndpoint', $array);
        $this->assertEquals('_pushed_auth_req_endpoint_', $array['pushedAuthReqEndpoint']);

        // mtlsEndpointAliases
        $this->assertArrayHasKey('mtlsEndpointAliases', $array);
        $mtlsEndpointAliases = $array['mtlsEndpointAliases'];

        $this->assertTrue(is_array($mtlsEndpointAliases));
        $this->assertCount(2, $mtlsEndpointAliases);

        $mtlsEndpointAliases0 = $mtlsEndpointAliases[0];
        $this->assertTrue(is_array($mtlsEndpointAliases0));
        $this->assertArrayHasKey('name', $mtlsEndpointAliases0);
        $this->assertEquals('name-0', $mtlsEndpointAliases0['name']);
        $this->assertArrayHasKey('uri', $mtlsEndpointAliases0);
        $this->assertEquals('uri-0', $mtlsEndpointAliases0['uri']);

        $mtlsEndpointAliases1 = $mtlsEndpointAliases[1];
        $this->assertTrue(is_array($mtlsEndpointAliases1));
        $this->assertArrayHasKey('name', $mtlsEndpointAliases1);
        $this->assertEquals('name-1', $mtlsEndpointAliases1['name']);
        $this->assertArrayHasKey('uri', $mtlsEndpointAliases1);
        $this->assertEquals('uri-1', $mtlsEndpointAliases1['uri']);

        // supportedAuthorizationDataTypes
        $this->assertArrayHasKey('supportedAuthorizationDataTypes', $array);
        $authorizationDataTypes = $array['supportedAuthorizationDataTypes'];

        $this->assertTrue(is_array($authorizationDataTypes));
        $this->assertCount(2, $authorizationDataTypes);
        $this->assertEquals('type-0', $authorizationDataTypes[0]);
        $this->assertEquals('type-1', $authorizationDataTypes[1]);

        // supportedTrustFrameworks
        $this->assertArrayHasKey('supportedTrustFrameworks', $array);
        $trustFrameworks = $array['supportedTrustFrameworks'];

        $this->assertTrue(is_array($trustFrameworks));
        $this->assertCount(2, $trustFrameworks);
        $this->assertEquals('framework-0', $trustFrameworks[0]);
        $this->assertEquals('framework-1', $trustFrameworks[1]);

        // supportedEvidence
        $this->assertArrayHasKey('supportedEvidence', $array);
        $evidence = $array['supportedEvidence'];

        $this->assertTrue(is_array($evidence));
        $this->assertCount(2, $evidence);
        $this->assertEquals('evidence-0', $evidence[0]);
        $this->assertEquals('evidence-1', $evidence[1]);

        // supportedIdentityDocuments
        $this->assertArrayHasKey('supportedIdentityDocuments', $array);
        $idDocuments = $array['supportedIdentityDocuments'];

        $this->assertTrue(is_array($idDocuments));
        $this->assertCount(2, $idDocuments);
        $this->assertEquals('document-0', $idDocuments[0]);
        $this->assertEquals('document-1', $idDocuments[1]);

        // supportedVerificationMethods
        $this->assertArrayHasKey('supportedVerificationMethods', $array);
        $verificationMethods = $array['supportedVerificationMethods'];

        $this->assertTrue(is_array($verificationMethods));
        $this->assertCount(2, $verificationMethods);
        $this->assertEquals('method-0', $verificationMethods[0]);
        $this->assertEquals('method-1', $verificationMethods[1]);

        // supportedVerifiedClaims
        $this->assertArrayHasKey('supportedVerifiedClaims', $array);
        $verifiedClaims = $array['supportedVerifiedClaims'];

        $this->assertTrue(is_array($verifiedClaims));
        $this->assertCount(2, $verifiedClaims);
        $this->assertEquals('claim-0', $verifiedClaims[0]);
        $this->assertEquals('claim-1', $verifiedClaims[1]);

        // missingClientIdAllowed
        $this->assertArrayHasKey('missingClientIdAllowed', $array);
        $this->assertTrue($array['missingClientIdAllowed']);

        // parRequired
        $this->assertArrayHasKey('parRequired', $array);
        $this->assertTrue($array['parRequired']);

        // requestObjectRequired
        $this->assertArrayHasKey('requestObjectRequired', $array);
        $this->assertTrue($array['requestObjectRequired']);

        // traditionalRequestObjectProcessingApplied
        $this->assertArrayHasKey('traditionalRequestObjectProcessingApplied', $array);
        $this->assertTrue($array['traditionalRequestObjectProcessingApplied']);

        // claimShortcutRestrictive
        $this->assertArrayHasKey('claimShortcutRestrictive', $array);
        $this->assertTrue($array['claimShortcutRestrictive']);

        // scopeRequired
        $this->assertArrayHasKey('scopeRequired', $array);
        $this->assertTrue($array['scopeRequired']);

        // nbfOptional
        $this->assertArrayHasKey('nbfOptional', $array);
        $this->assertTrue($array['nbfOptional']);
    }


    public function testGetters()
    {
        $obj = $this->buildService();

        // serviceName
        $this->assertEquals('MyService', $obj->getServiceName());

        // apiKey
        $this->assertEquals(1, $obj->getApiKey());

        // apiSecret
        $this->assertEquals('secret', $obj->getApiSecret());

        // issuer
        $this->assertEquals('_issuer_', $obj->getIssuer());

        // authorizationEndpoint
        $this->assertEquals('_authorization_endpoint_', $obj->getAuthorizationEndpoint());

        // tokenEndpoint
        $this->assertEquals('_token_endpoint_', $obj->getTokenEndpoint());

        // revocationEndpoint
        $this->assertEquals('_revocation_endpoint_', $obj->getRevocationEndpoint());

        // supportedRevocationAuthMethods
        $revocationAuthMethods = $obj->getSupportedRevocationAuthMethods();

        $this->assertTrue(is_array($revocationAuthMethods));
        $this->assertCount(2, $revocationAuthMethods);
        $this->assertEquals(ClientAuthMethod::$CLIENT_SECRET_POST, $revocationAuthMethods[0]);
        $this->assertEquals(ClientAuthMethod::$CLIENT_SECRET_JWT,  $revocationAuthMethods[1]);

        // userInfoEndpoint
        $this->assertEquals('_userinfo_endpoint_', $obj->getUserInfoEndpoint());

        // jwksUri
        $this->assertEquals('_jwks_uri_', $obj->getJwksUri());

        // jwks
        $this->assertEquals('_jwks_', $obj->getJwks());

        // registrationEndpoint
        $this->assertEquals('_registration_endpoint_', $obj->getRegistrationEndpoint());

        // registrationManagementEndpoint
        $this->assertEquals('_registration_management_endpoint_', $obj->getRegistrationManagementEndpoint());

        // supportedScopes
        $scopes = $obj->getSupportedScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(2, $scopes);

        $scope0 = $scopes[0];
        $this->assertEquals('scope-0', $scope0->getName());

        $scope1 = $scopes[1];
        $this->assertEquals('scope-1', $scope1->getName());

        // supportedResponseTypes
        $responseTypes = $obj->getSupportedResponseTypes();

        $this->assertTrue(is_array($responseTypes));
        $this->assertCount(2, $responseTypes);
        $this->assertEquals(ResponseType::$CODE,  $responseTypes[0]);
        $this->assertEquals(ResponseType::$TOKEN, $responseTypes[1]);

        // supportedGrantTypes
        $grantTypes = $obj->getSupportedGrantTypes();

        $this->assertTrue(is_array($grantTypes));
        $this->assertCount(2, $grantTypes);
        $this->assertEquals(GrantType::$AUTHORIZATION_CODE, $grantTypes[0]);
        $this->assertEquals(GrantType::$IMPLICIT,           $grantTypes[1]);

        // supportedAcrs
        $acrs = $obj->getSupportedAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr-0', $acrs[0]);
        $this->assertEquals('acr-1', $acrs[1]);

        // supportedTokenAuthMethods
        $tokenAuthMethods = $obj->getSupportedTokenAuthMethods();

        $this->assertTrue(is_array($tokenAuthMethods));
        $this->assertCount(2, $tokenAuthMethods);
        $this->assertEquals(ClientAuthMethod::$PRIVATE_KEY_JWT, $tokenAuthMethods[0]);
        $this->assertEquals(ClientAuthMethod::$TLS_CLIENT_AUTH, $tokenAuthMethods[1]);

        // supportedDisplays
        $displays = $obj->getSupportedDisplays();

        $this->assertTrue(is_array($displays));
        $this->assertCount(2, $displays);
        $this->assertEquals(Display::$PAGE,  $displays[0]);
        $this->assertEquals(Display::$POPUP, $displays[1]);

        // supportedClaimTypes
        $claimTypes = $obj->getSupportedClaimTypes();

        $this->assertTrue(is_array($claimTypes));
        $this->assertCount(2, $claimTypes);
        $this->assertEquals(ClaimType::$NORMAL,     $claimTypes[0]);
        $this->assertEquals(ClaimType::$AGGREGATED, $claimTypes[1]);

        // supportedClaims
        $claims = $obj->getSupportedClaims();

        $this->assertTrue(is_array($claims));
        $this->assertCount(2, $claims);
        $this->assertEquals('claim-0', $claims[0]);
        $this->assertEquals('claim-1', $claims[1]);

        // serviceDocumentation
        $this->assertEquals('_service_documentation_', $obj->getServiceDocumentation());

        // supportedClaimLocales
        $claimLocales = $obj->getSupportedClaimLocales();

        $this->assertTrue(is_array($claimLocales));
        $this->assertCount(2, $claimLocales);
        $this->assertEquals('claim-locale-0', $claimLocales[0]);
        $this->assertEquals('claim-locale-1', $claimLocales[1]);

        // supportedUiLocales
        $uiLocales = $obj->getSupportedUiLocales();

        $this->assertTrue(is_array($uiLocales));
        $this->assertCount(2, $uiLocales);
        $this->assertEquals('ui-locale-0', $uiLocales[0]);
        $this->assertEquals('ui-locale-1', $uiLocales[1]);

        // policyUri
        $this->assertEquals('_policy_uri_', $obj->getPolicyUri());

        // tosUri
        $this->assertEquals('_tos_uri_', $obj->getTosUri());

        // authenticationCallbackEndpoint
        $this->assertEquals('_authentication_callback_endpoint_', $obj->getAuthenticationCallbackEndpoint());

        // authenticationCallbackApiKey
        $this->assertEquals('_authentication_callback_api_key_', $obj->getAuthenticationCallbackApiKey());

        // authenticationCallbackApiSecret
        $this->assertEquals('_authentication_callback_api_secret_', $obj->getAuthenticationCallbackApiSecret());

        // supportedSnses
        $snses = $obj->getSupportedSnses();

        $this->assertTrue(is_array($snses));
        $this->assertCount(1, $snses);
        $this->assertEquals(Sns::$FACEBOOK, $snses[0]);

        // snsCredentials
        $snsCredentials = $obj->getSnsCredentials();

        $this->assertTrue(is_array($snsCredentials));
        $this->assertCount(1, $snsCredentials);

        $snsCredentials0 = $snsCredentials[0];
        $this->assertEquals(Sns::$FACEBOOK, $snsCredentials0->getSns());
        $this->assertEquals('_sns_api_key_', $snsCredentials0->getApiKey());
        $this->assertEquals('_sns_api_secret_', $snsCredentials0->getApiSecret());

        // createdAt
        $this->assertEquals(12345, $obj->getCreatedAt());

        // modifiedAt
        $this->assertEquals(67890, $obj->getModifiedAt());

        // developerAuthenticationCallbackEndpoint
        $this->assertEquals('_developer_authentication_callback_endpoint_', $obj->getDeveloperAuthenticationCallbackEndpoint());

        // developerAuthenticationCallbackApiKey
        $this->assertEquals('_developer_authentication_callback_api_key_', $obj->getDeveloperAuthenticationCallbackApiKey());

        // developerAuthenticationCallbackApiSecret
        $this->assertEquals('_developer_authentication_callback_api_secret_', $obj->getDeveloperAuthenticationCallbackApiSecret());

        // supportedDeveloperSnses
        $developerSnses = $obj->getSupportedDeveloperSnses();

        $this->assertTrue(is_array($developerSnses));
        $this->assertCount(1, $developerSnses);
        $this->assertEquals(Sns::$FACEBOOK, $developerSnses[0]);

        // developerSnsCredentials
        $developerSnsCredentials = $obj->getDeveloperSnsCredentials();

        $this->assertTrue(is_array($developerSnsCredentials));
        $this->assertCount(1, $developerSnsCredentials);

        $developerSnsCredentials0 = $developerSnsCredentials[0];
        $this->assertEquals(Sns::$FACEBOOK, $developerSnsCredentials0->getSns());
        $this->assertEquals('_developer_sns_api_key_', $developerSnsCredentials0->getApiKey());
        $this->assertEquals('_developer_sns_api_secret_', $developerSnsCredentials0->getApiSecret());

        // clientsPerDeveloper
        $this->assertEquals(10, $obj->getClientsPerDeveloper());

        // directAuthorizationEndpointEnabled
        $this->assertTrue($obj->isDirectAuthorizationEndpointEnabled());

        // directTokenEndpointEnabled
        $this->assertTrue($obj->isDirectTokenEndpointEnabled());

        // directRevocationEndpointEnabled
        $this->assertTrue($obj->isDirectRevocationEndpointEnabled());

        // directUserInfoEndpointEnabled
        $this->assertTrue($obj->isDirectUserInfoEndpointEnabled());

        // directJwksEndpointEnabled
        $this->assertTrue($obj->isDirectJwksEndpointEnabled());

        // directIntrospectionEndpointEnabled
        $this->assertTrue($obj->isDirectIntrospectionEndpointEnabled());

        // singleAccessTokenPerSubject
        $this->assertTrue($obj->isSingleAccessTokenPerSubject());

        // pkceRequired
        $this->assertTrue($obj->isPkceRequired());

        // pkceS256Required
        $this->assertTrue($obj->isPkceS256Required());

        // refreshTokenKept
        $this->assertTrue($obj->isRefreshTokenKept());

        // refreshTokenDurationKept
        $this->assertTrue($obj->isRefreshTokenDurationKept());

        // errorDescriptionOmitted
        $this->assertTrue($obj->isErrorDescriptionOmitted());

        // errorUriOmitted
        $this->assertTrue($obj->isErrorUriOmitted());

        // clientIdAliasEnabled
        $this->assertTrue($obj->isClientIdAliasEnabled());

        // supportedServiceProfiles
        $serviceProfiles = $obj->getSupportedServiceProfiles();

        $this->assertTrue(is_array($serviceProfiles));
        $this->assertCount(2, $serviceProfiles);
        $this->assertEquals(ServiceProfile::$FAPI, $serviceProfiles[0]);
        $this->assertEquals(ServiceProfile::$OPEN_BANKING, $serviceProfiles[1]);

        // tlsClientCertificateBoundAccessTokens
        $this->assertTrue($obj->isTlsClientCertificateBoundAccessTokens());

        // introspectionEndpoint
        $this->assertEquals('_introspection_endpoint_', $obj->getIntrospectionEndpoint());

        // supportedIntrospectionAuthMethods
        $introspectionAuthMethods = $obj->getSupportedIntrospectionAuthMethods();

        $this->assertTrue(is_array($introspectionAuthMethods));
        $this->assertCount(2, $introspectionAuthMethods);
        $this->assertEquals(ClientAuthMethod::$TLS_CLIENT_AUTH,             $introspectionAuthMethods[0]);
        $this->assertEquals(ClientAuthMethod::$SELF_SIGNED_TLS_CLIENT_AUTH, $introspectionAuthMethods[1]);

        // mutualTlsValidatePkiCertChain
        $this->assertTrue($obj->isMutualTlsValidatePkiCertChain());

        // trustedRootCertificates
        $rootCertificates = $obj->getTrustedRootCertificates();

        $this->assertTrue(is_array($rootCertificates));
        $this->assertCount(2, $rootCertificates);
        $this->assertEquals('root-certificate-0', $rootCertificates[0]);
        $this->assertEquals('root-certificate-1', $rootCertificates[1]);

        // dynamicRegistrationSupported
        $this->assertTrue($obj->isDynamicRegistrationSupported());

        // endSessionEndpoint
        $this->assertEquals('_end_session_endpoint_', $obj->getEndSessionEndpoint());

        // description
        $this->assertEquals('_description_', $obj->getDescription());

        // accessTokenType
        $this->assertEquals('Bearer', $obj->getAccessTokenType());

        // accessTokenSignAlg
        $this->assertEquals(JWSAlg::$ES256, $obj->getAccessTokenSignAlg());

        // accessTokenDuration
        $this->assertEquals(1234, $obj->getAccessTokenDuration());

        // refreshTokenDuration
        $this->assertEquals(5678, $obj->getRefreshTokenDuration());

        // idTokenDuration
        $this->assertEquals(9012, $obj->getIdTokenDuration());

        // authorizationResponseDuration
        $this->assertEquals(1111, $obj->getAuthorizationResponseDuration());

        // pushedAuthReqDuration
        $this->assertEquals(2222, $obj->getPushedAuthReqDuration());

        // accessTokenSignatureKeyId
        $this->assertEquals('access_token_signature_key_id', $obj->getAccessTokenSignatureKeyId());

        // authorizationSignatureKeyId
        $this->assertEquals('authorization_signature_key_id', $obj->getAuthorizationSignatureKeyId());

        // idTokenSignatureKeyId
        $this->assertEquals('id_token_signature_key_id', $obj->getIdTokenSignatureKeyId());

        // userInfoSignatureKeyId
        $this->assertEquals('userinfo_signature_key_id', $obj->getUserInfoSignatureKeyId());

        // supportedBackchannelTokenDeliveryModes
        $deliveryModes = $obj->getSupportedBackchannelTokenDeliveryModes();

        $this->assertTrue(is_array($deliveryModes));
        $this->assertCount(3, $deliveryModes);
        $this->assertEquals(DeliveryMode::$POLL, $deliveryModes[0]);
        $this->assertEquals(DeliveryMode::$PING, $deliveryModes[1]);
        $this->assertEquals(DeliveryMode::$PUSH, $deliveryModes[2]);

        // backchannelAuthenticationEndpoint
        $this->assertEquals('_backchannel_authentication_endpoint_', $obj->getBackchannelAuthenticationEndpoint());

        // backchannelUserCodeParameterSupported
        $this->assertTrue($obj->isBackchannelUserCodeParameterSupported());

        // backchannelAuthReqIdDuration
        $this->assertEquals(3333, $obj->getBackchannelAuthReqIdDuration());

        // backchannelPollingInterval
        $this->assertEquals(4444, $obj->getBackchannelPollingInterval());

        // backchannelBindingMessageRequiredInFapi
        $this->assertTrue($obj->isBackchannelBindingMessageRequiredInFapi());

        // allowableClockSkew
        $this->assertEquals(60, $obj->getAllowableClockSkew());

        // deviceAuthorizationEndpoint
        $this->assertEquals('_device_authorization_endpoint_', $obj->getDeviceAuthorizationEndpoint());

        // deviceVerificationUri
        $this->assertEquals('_device_verification_uri_', $obj->getDeviceVerificationUri());

        // deviceVerificationUriComplete
        $this->assertEquals('_device_verification_uri_complete_', $obj->getDeviceVerificationUriComplete());

        // deviceFlowCodeDuration
        $this->assertEquals(5555, $obj->getDeviceFlowCodeDuration());

        // deviceFlowPollingInterval
        $this->assertEquals(6666, $obj->getDeviceFlowPollingInterval());

        // userCodeCharset
        $this->assertEquals(UserCodeCharset::$BASE20, $obj->getUserCodeCharset());

        // userCodeLength
        $this->assertEquals(10, $obj->getUserCodeLength());

        // pushedAuthReqEndpoint
        $this->assertEquals('_pushed_auth_req_endpoint_', $obj->getPushedAuthReqEndpoint());

        // mtlsEndpointAliases
        $mtlsEndpointAliases = $obj->getMtlsEndpointAliases();

        $this->assertTrue(is_array($mtlsEndpointAliases));
        $this->assertCount(2, $mtlsEndpointAliases);

        $mtlsEndpointAliases0 = $mtlsEndpointAliases[0];
        $this->assertEquals('name-0', $mtlsEndpointAliases0->getName());
        $this->assertEquals('uri-0', $mtlsEndpointAliases0->getUri());

        $mtlsEndpointAliases1 = $mtlsEndpointAliases[1];
        $this->assertEquals('name-1', $mtlsEndpointAliases1->getName());
        $this->assertEquals('uri-1', $mtlsEndpointAliases1->getUri());

        // supportedAuthorizationDataTypes
        $authorizationDataTypes = $obj->getSupportedAuthorizationDataTypes();

        $this->assertTrue(is_array($authorizationDataTypes));
        $this->assertCount(2, $authorizationDataTypes);
        $this->assertEquals('type-0', $authorizationDataTypes[0]);
        $this->assertEquals('type-1', $authorizationDataTypes[1]);

        // supportedTrustFrameworks
        $trustFrameworks = $obj->getSupportedTrustFrameworks();

        $this->assertTrue(is_array($trustFrameworks));
        $this->assertCount(2, $trustFrameworks);
        $this->assertEquals('framework-0', $trustFrameworks[0]);
        $this->assertEquals('framework-1', $trustFrameworks[1]);

        // supportedEvidence
        $evidence = $obj->getSupportedEvidence();

        $this->assertTrue(is_array($evidence));
        $this->assertCount(2, $evidence);
        $this->assertEquals('evidence-0', $evidence[0]);
        $this->assertEquals('evidence-1', $evidence[1]);

        // supportedIdentityDocuments
        $idDocuments = $obj->getSupportedIdentityDocuments();

        $this->assertTrue(is_array($idDocuments));
        $this->assertCount(2, $idDocuments);
        $this->assertEquals('document-0', $idDocuments[0]);
        $this->assertEquals('document-1', $idDocuments[1]);

        // supportedVerificationMethods
        $verificationMethods = $obj->getSupportedVerificationMethods();

        $this->assertTrue(is_array($verificationMethods));
        $this->assertCount(2, $verificationMethods);
        $this->assertEquals('method-0', $verificationMethods[0]);
        $this->assertEquals('method-1', $verificationMethods[1]);

        // supportedVerifiedClaims
        $verifiedClaims = $obj->getSupportedVerifiedClaims();

        $this->assertTrue(is_array($verifiedClaims));
        $this->assertCount(2, $verifiedClaims);
        $this->assertEquals('claim-0', $verifiedClaims[0]);
        $this->assertEquals('claim-1', $verifiedClaims[1]);

        // missingClientIdAllowed
        $this->assertTrue($obj->isMissingClientIdAllowed());

        // parRequired
        $this->assertTrue($obj->isParRequired());

        // requestObjectRequired
        $this->assertTrue($obj->isRequestObjectRequired());

        // traditionalRequestObjectProcessingApplied
        $this->assertTrue($obj->isTraditionalRequestObjectProcessingApplied());

        // claimShortcutRestrictive
        $this->assertTrue($obj->isClaimShortcutRestrictive());

        // scopeRequired
        $this->assertTrue($obj->isScopeRequired());

        // nbfOptional
        $this->assertTrue($obj->isNbfOptional());
    }
}
?>
