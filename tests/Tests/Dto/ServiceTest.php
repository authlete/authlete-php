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
use Authlete\Dto\Scope;
use Authlete\Dto\Service;
use Authlete\Dto\SnsCredentials;
use Authlete\Types\ClaimType;
use Authlete\Types\ClientAuthMethod;
use Authlete\Types\Display;
use Authlete\Types\GrantType;
use Authlete\Types\JWSAlg;
use Authlete\Types\ResponseType;
use Authlete\Types\ServiceProfile;
use Authlete\Types\Sns;


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


    public function testSupportedRevocationAuthSigningAlgorithmsValidValue()
    {
        $obj = new Service();

        $array = array(
            JWSAlg::$HS256,
            JWSAlg::$ES256
        );
        $obj->setSupportedRevocationAuthSigningAlgorithms($array);

        $algs = $obj->getSupportedRevocationAuthSigningAlgorithms();

        $this->assertTrue(is_array($algs));
        $this->assertCount(2, $algs);
        $this->assertSame(JWSAlg::$HS256, $algs[0]);
        $this->assertSame(JWSAlg::$ES256, $algs[1]);
    }


    public function testSupportedRevocationAuthSigningAlgorithmsValidNull()
    {
        $obj = new Service();
        $obj->setSupportedRevocationAuthSigningAlgorithms(null);

        $this->assertNull($obj->getSupportedRevocationAuthSigningAlgorithms());
    }


    /**
     * @expectedException Error
     */
    public function testSupportedRevocationAuthSigningAlgorithmsInvalidType()
    {
        $obj = new Service();

        $invalid = '__INVALID__';
        $obj->setSupportedRevocationAuthSigningAlgorithms($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSupportedRevocationAuthSigningAlgorithmsInvalidElement()
    {
        $obj = new Service();

        $invalid = array('__INVALID__');
        $obj->setSupportedRevocationAuthSigningAlgorithms($invalid);
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


    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsValidValue()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":["HS256","ES256"]}';
        $obj  = Service::fromJson($json);

        $algs = $obj->getSupportedRevocationAuthSigningAlgorithms();

        $this->assertTrue(is_array($algs));
        $this->assertCount(2, $algs);
        $this->assertEquals(JWSAlg::$HS256, $algs[0]);
        $this->assertEquals(JWSAlg::$ES256, $algs[1]);
    }


    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsValidNull()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":null}';
        $obj  = Service::fromJson($json);

        $this->assertNull($obj->getSupportedRevocationAuthSigningAlgorithms());
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsInvalidBool()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":true}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsInvalidNumber()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":123}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsInvalidString()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":"__INVALID__"}';
        $obj  = Service::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSupportedRevocationAuthSigningAlgorithmsInvalidElement()
    {
        $json = '{"supportedRevocationAuthSigningAlgorithms":["__INVALID__"]}';
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


    public function testToJson()
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
            ->setSupportedRevocationAuthSigningAlgorithms(
                array(
                    JWSAlg::$HS256,
                    JWSAlg::$ES256
                )
            )
            ->setUserInfoEndpoint('_userinfo_endpoint_')
            ->setJwksUri('_jwks_uri_')
            ->setJwks('_jwks_')
            ->setRegistrationEndpoint('_registration_endpoint_')
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
            ->setDescription('_description_')
            ->setAccessTokenType('Bearer')
            ->setAccessTokenDuration(1234)
            ->setRefreshTokenDuration(5678)
            ->setIdTokenDuration(9012)
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
            ->setSupportedServiceProfiles(
                array(
                    ServiceProfile::$FAPI
                )
            )
            ->setTlsClientCertificateBoundAccessTokens(true)
            ->setMutualTlsValidatePkiCertChain(true)
            ->setIntrospectionEndpoint('_introspection_endpoint_')
            ->setSupportedIntrospectionAuthMethods(
                array(
                    ClientAuthMethod::$TLS_CLIENT_AUTH,
                    ClientAuthMethod::$SELF_SIGNED_TLS_CLIENT_AUTH
                )
            )
            ->setSupportedIntrospectionAuthSigningAlgorithms(
                array(
                    JWSAlg::$HS384,
                    JWSAlg::$ES384
                )
            )
            ->setTrustedRootCertificates(
                array(
                    "root-certificate-0",
                    "root-certificate-1"
                )
            )
            ;

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

        // supportedRevocationAuthSigningAlgorithms
        $this->assertArrayHasKey('supportedRevocationAuthSigningAlgorithms', $array);
        $revocationAuthSigningAlgorithms = $array['supportedRevocationAuthSigningAlgorithms'];

        $this->assertTrue(is_array($revocationAuthSigningAlgorithms));
        $this->assertCount(2, $revocationAuthSigningAlgorithms);
        $this->assertEquals('HS256', $revocationAuthSigningAlgorithms[0]);
        $this->assertEquals('ES256', $revocationAuthSigningAlgorithms[1]);

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

        // description
        $this->assertArrayHasKey('description', $array);
        $this->assertEquals('_description_', $array['description']);

        // accessTokenType
        $this->assertArrayHasKey('accessTokenType', $array);
        $this->assertEquals('Bearer', $array['accessTokenType']);

        // accessTokenDuration
        $this->assertArrayHasKey('accessTokenDuration', $array);
        $this->assertEquals(1234, $array['accessTokenDuration']);

        // refreshTokenDuration
        $this->assertArrayHasKey('refreshTokenDuration', $array);
        $this->assertEquals(5678, $array['refreshTokenDuration']);

        // idTokenDuration
        $this->assertArrayHasKey('idTokenDuration', $array);
        $this->assertEquals(9012, $array['idTokenDuration']);

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

        // supportedServiceProfiles
        $this->assertArrayHasKey('supportedServiceProfiles', $array);
        $serviceProfiles = $array['supportedServiceProfiles'];

        $this->assertTrue(is_array($serviceProfiles));
        $this->assertCount(1, $serviceProfiles);
        $this->assertEquals('FAPI', $serviceProfiles[0]);

        // tlsClientCertificateBoundAccessTokens
        $this->assertArrayHasKey('tlsClientCertificateBoundAccessTokens', $array);
        $this->assertTrue($array['tlsClientCertificateBoundAccessTokens']);

        // mutualTlsValidatePkiCertChain
        $this->assertArrayHasKey('mutualTlsValidatePkiCertChain', $array);
        $this->assertTrue($array['mutualTlsValidatePkiCertChain']);

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

        // supportedIntrospectionAuthSigningAlgorithms
        $this->assertArrayHasKey('supportedIntrospectionAuthSigningAlgorithms', $array);
        $introspectionAuthSigningAlgorithms = $array['supportedIntrospectionAuthSigningAlgorithms'];

        $this->assertTrue(is_array($introspectionAuthSigningAlgorithms));
        $this->assertCount(2, $introspectionAuthSigningAlgorithms);
        $this->assertEquals('HS384', $introspectionAuthSigningAlgorithms[0]);
        $this->assertEquals('ES384', $introspectionAuthSigningAlgorithms[1]);

        // trustedRootCertificates
        $this->assertArrayHasKey('trustedRootCertificates', $array);
        $rootCertificates = $array['trustedRootCertificates'];

        $this->assertTrue(is_array($rootCertificates));
        $this->assertCount(2, $rootCertificates);
        $this->assertEquals('root-certificate-0', $rootCertificates[0]);
        $this->assertEquals('root-certificate-1', $rootCertificates[1]);
    }
}
?>
