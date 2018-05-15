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
use Authlete\Dto\AuthorizationAction;
use Authlete\Dto\AuthorizationResponse;
use Authlete\Dto\Client;
use Authlete\Dto\Scope;
use Authlete\Dto\Service;
use Authlete\Types\Display;
use Authlete\Types\Prompt;


class AuthorizationResponseTest extends TestCase
{
    public function testResultCodeValidValue()
    {
        $obj = new AuthorizationResponse();

        $resultCode = 'code';
        $obj->setResultCode($resultCode);

        $this->assertEquals($resultCode, $obj->getResultCode());
    }


    public function testResultCodeValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setResultCode(null);

        $this->assertNull($obj->getResultCode());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testResultCodeInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setResultCode($invalid);
    }


    public function testResultMessageValidValue()
    {
        $obj = new AuthorizationResponse();

        $resultMessage = 'message';
        $obj->setResultMessage($resultMessage);

        $this->assertEquals($resultMessage, $obj->getResultMessage());
    }


    public function testResultMessageValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setResultMessage(null);

        $this->assertNull($obj->getResultMessage());
    }


    /** @expectedException InvalidArgumentException */
    public function testResultMessageInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setResultMessage($invalid);
    }


    public function testActionValidValue()
    {
        $obj = new AuthorizationResponse();

        $action = AuthorizationAction::$INTERACTION;
        $obj->setAction($action);

        $this->assertSame($action, $obj->getAction());
    }


    public function testActionValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setAction(null);

        $this->assertNull($obj->getAction());
    }


    public function testServiceValidValue()
    {
        $obj = new AuthorizationResponse();

        $service = new Service();
        $obj->setService($service);

        $this->assertSame($service, $obj->getService());
    }


    public function testServiceValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setService(null);

        $this->assertNull($obj->getService());
    }


    public function testClientValidValue()
    {
        $obj = new AuthorizationResponse();

        $client = new Client();
        $obj->setClient($client);

        $this->assertSame($client, $obj->getClient());
    }


    public function testClientValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setClient(null);

        $this->assertNull($obj->getClient());
    }


    public function testClientIdAliasUsedValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setClientIdAliasUsed(true);

        $this->assertEquals(true, $obj->isClientIdAliasUsed());
    }


    /** @expectedException InvalidArgumentException */
    public function testClientIdAliasUsedInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setClientIdAliasUsed($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testClientIdAliasUsedInvalidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setClientIdAliasUsed(null);
    }


    public function testDisplayValidValue()
    {
        $obj = new AuthorizationResponse();

        $display = Display::$PAGE;
        $obj->setDisplay($display);

        $this->assertSame($display, $obj->getDisplay());
    }


    public function testDisplayValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setDisplay(null);

        $this->assertNull($obj->getDisplay());
    }


    public function testMaxAgeValidInt()
    {
        $obj = new AuthorizationResponse();
        $obj->setMaxAge(123);

        $this->assertEquals(123, $obj->getMaxAge());
    }


    public function testMaxAgeValidStr()
    {
        $obj = new AuthorizationResponse();
        $obj->setMaxAge("456");

        $this->assertEquals("456", $obj->getMaxAge());
    }


    public function testMaxAgeValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setMaxAge(null);

        $this->assertNull($obj->getMaxAge());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testMaxAgeInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setMaxAge($invalid);
    }


    public function testScopesValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setScopes(array(
            (new Scope())->setName('scope0')
        ));

        $scopes = $obj->getScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(1, $scopes);

        $scope = $scopes[0];

        $this->assertInstanceOf('\Authlete\Dto\Scope', $scope);
        $this->assertEquals('scope0', $scope->getName());
    }


    public function testScopesValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setScopes(null);

        $this->assertNull($obj->getScopes());
    }


    /**
     * @expectedException Error
     */
    public function testScopesInvalidType()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setScopes($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testScopesInvalidElement()
    {
        $obj = new AuthorizationResponse();

        $invalid = array('__INVALID__');
        $obj->setScopes($invalid);
    }


    public function testUiLocalesValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setUiLocales(array('en', 'ja'));

        $locales = $obj->getUiLocales();

        $this->assertTrue(is_array($locales));
        $this->assertCount(2, $locales);
        $this->assertEquals('en', $locales[0]);
        $this->assertEquals('ja', $locales[1]);
    }


    public function testUiLocalesValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setUiLocales(null);

        $this->assertNull($obj->getUiLocales());
    }


    /**
     * @expectedException Error
     */
    public function testUiLocalesInvalidString()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setUiLocales($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testUiLocalesInvalidArray()
    {
        $obj = new AuthorizationResponse();

        $invalid = array(array(), array());
        $obj->setUiLocales($invalid);
    }


    public function testClaimsLocalesValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setClaimsLocales(array('en', 'ja'));

        $locales = $obj->getClaimsLocales();

        $this->assertTrue(is_array($locales));
        $this->assertCount(2, $locales);
        $this->assertEquals('en', $locales[0]);
        $this->assertEquals('ja', $locales[1]);
    }


    public function testClaimsLocalesValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setClaimsLocales(null);

        $this->assertNull($obj->getClaimsLocales());
    }


    /**
     * @expectedException Error
     */
    public function testClaimsLocalesInvalidString()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setClaimsLocales($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClaimsLocalesInvalidArray()
    {
        $obj = new AuthorizationResponse();

        $invalid = array(array(), array());
        $obj->setClaimsLocales($invalid);
    }


    public function testClaimsValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setClaims(array('name', 'email'));

        $claims = $obj->getClaims();

        $this->assertTrue(is_array($claims));
        $this->assertCount(2, $claims);
        $this->assertEquals('name',  $claims[0]);
        $this->assertEquals('email', $claims[1]);
    }


    public function testClaimsValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setClaims(null);

        $this->assertNull($obj->getClaims());
    }


    /**
     * @expectedException Error
     */
    public function testClaimsInvalidString()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setClaims($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testClaimsInvalidArray()
    {
        $obj = new AuthorizationResponse();

        $invalid = array(array(), array());
        $obj->setClaims($invalid);
    }


    public function testAcrEssentialValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setAcrEssential(true);

        $this->assertEquals(true, $obj->isAcrEssential());
    }


    /** @expectedException InvalidArgumentException */
    public function testAcrEssentialInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setAcrEssential($invalid);
    }


    /** @expectedException InvalidArgumentException */
    public function testAcrEssentialInvalidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setAcrEssential(null);
    }


    public function testAcrsValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setAcrs(array('acr0', 'acr1'));

        $acrs = $obj->getAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr0', $acrs[0]);
        $this->assertEquals('acr1', $acrs[1]);
    }


    public function testAcrsValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setAcrs(null);

        $this->assertNull($obj->getAcrs());
    }


    /**
     * @expectedException Error
     */
    public function testAcrsInvalidString()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setAcrs($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testAcrsInvalidArray()
    {
        $obj = new AuthorizationResponse();

        $invalid = array(array(), array());
        $obj->setAcrs($invalid);
    }


    public function testSubjectValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setSubject('_subject_');

        $this->assertEquals('_subject_', $obj->getSubject());
    }


    public function testSubjectValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setSubject(null);

        $this->assertNull($obj->getSubject());
    }


    /** @expectedException InvalidArgumentException */
    public function testSubjectInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setSubject($invalid);
    }


    public function testLoginHintValidValue()
    {
        $obj = new AuthorizationResponse();
        $obj->setLoginHint('hint');

        $this->assertEquals('hint', $obj->getLoginHint());
    }


    public function testLoginHintValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setLoginHint(null);

        $this->assertNull($obj->getLoginHint());
    }


    /** @expectedException InvalidArgumentException */
    public function testLoginHintInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setLoginHint($invalid);
    }


    public function testPromptsValidValue()
    {
        $obj = new AuthorizationResponse();

        $array = array(
            Prompt::$NONE,
            Prompt::$LOGIN
        );
        $obj->setPrompts($array);

        $prompts = $obj->getPrompts();

        $this->assertTrue(is_array($prompts));
        $this->assertCount(2, $prompts);
        $this->assertSame(Prompt::$NONE,  $prompts[0]);
        $this->assertSame(Prompt::$LOGIN, $prompts[1]);
    }


    public function testPromptsValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setPrompts(null);

        $this->assertNull($obj->getPrompts());
    }


    /**
     * @expectedException Error
     */
    public function testPromptsInvalidType()
    {
        $obj = new AuthorizationResponse();

        $invalid = '__INVALID__';
        $obj->setPrompts($invalid);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testPromptsInvalidElement()
    {
        $obj = new AuthorizationResponse();

        $invalid = array('__INVALID__');
        $obj->setPrompts($invalid);
    }


    public function testResponseContentValidValue()
    {
        $obj = new AuthorizationResponse();

        $responseContent = 'content';
        $obj->setResponseContent($responseContent);

        $this->assertEquals($responseContent, $obj->getResponseContent());
    }


    public function testResponseContentValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setResponseContent(null);

        $this->assertNull($obj->getResponseContent());
    }


    /** @expectedException InvalidArgumentException */
    public function testResponseContentInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setResponseContent($invalid);
    }


    public function testTicketValidValue()
    {
        $obj = new AuthorizationResponse();

        $ticket = '_ticket_';
        $obj->setTicket($ticket);

        $this->assertEquals($ticket, $obj->getTicket());
    }


    public function testTicketValidNull()
    {
        $obj = new AuthorizationResponse();
        $obj->setTicket(null);

        $this->assertNull($obj->getTicket());
    }


    /** @expectedException InvalidArgumentException */
    public function testTicketInvalidValue()
    {
        $obj = new AuthorizationResponse();

        $invalid = array();
        $obj->setTicket($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertInstanceof(AuthorizationResponse::class, $obj);
    }


    public function testFromJsonResultCodeValidValue()
    {
        $json = '{"resultCode":"code"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('code', $obj->getResultCode());
    }


    public function testFromJsonResultCodeValidNull()
    {
        $json = '{"resultCode":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getResultCode());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidBool()
    {
        $json = '{"resultCode":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidNumber()
    {
        $json = '{"resultCode":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidArray()
    {
        $json = '{"resultCode":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidObject()
    {
        $json = '{"resultCode":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonResultMessageValidValue()
    {
        $json = '{"resultMessage":"message"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('message', $obj->getResultMessage());
    }


    public function testFromJsonResultMessageValidNull()
    {
        $json = '{"resultMessage":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getResultMessage());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidBool()
    {
        $json = '{"resultMessage":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidNumber()
    {
        $json = '{"resultMessage":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidArray()
    {
        $json = '{"resultMessage":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidObject()
    {
        $json = '{"resultMessage":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonActionValidValue()
    {
        $json = '{"action":"INTERACTION"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertSame(AuthorizationAction::$INTERACTION, $obj->getAction());
    }


    public function testFromJsonActionValidNull()
    {
        $json = '{"action":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getAction());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidBool()
    {
        $json = '{"action":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidNumber()
    {
        $json = '{"action":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidArray()
    {
        $json = '{"action":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidObject()
    {
        $json = '{"action":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonServiceValidValue()
    {
        $json = '{"service":{"serviceName":"MyService"}}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertInstanceOf('\Authlete\Dto\Service', $obj->getService());
        $this->assertEquals('MyService', $obj->getService()->getServiceName());
    }


    public function testFromJsonServiceValidNull()
    {
        $json = '{"service":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getService());
    }


    /** @expectedException TypeError */
    public function testFromJsonServiceInvalidBool()
    {
        $json = '{"service":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException TypeError */
    public function testFromJsonServiceInvalidNumber()
    {
        $json = '{"service":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonClientValidValue()
    {
        $json = '{"client":{"clientName":"MyClient"}}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertInstanceOf('\Authlete\Dto\Client', $obj->getClient());
        $this->assertEquals('MyClient', $obj->getClient()->getClientName());
    }


    public function testFromJsonClientValidNull()
    {
        $json = '{"client":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getClient());
    }


    /** @expectedException TypeError */
    public function testFromJsonClientInvalidBool()
    {
        $json = '{"client":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException TypeError */
    public function testFromJsonClientInvalidNumber()
    {
        $json = '{"client":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonClientIdAliasUsedValidValue()
    {
        $json = '{"clientIdAliasUsed":true}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasUsed());
    }


    public function testFromJsonClientIdAliasUsedValidNull()
    {
        $json = '{"clientIdAliasUsed":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasUsed());
    }


    public function testFromJsonClientIdAliasUsedValidStringTrue()
    {
        $json = '{"clientIdAliasUsed":"true"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(true, $obj->isClientIdAliasUsed());
    }


    public function testFromJsonClientIdAliasUsedValidStringFalse()
    {
        $json = '{"clientIdAliasUsed":"false"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasUsed());
    }


    public function testFromJsonClientIdAliasUsedInvalidString()
    {
        $json = '{"clientIdAliasUsed":"__INVALID__"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isClientIdAliasUsed());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonClientIdAliasUsedInvalidType()
    {
        $json = '{"clientIdAliasUsed":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonDisplayValidValue()
    {
        $json = '{"display":"PAGE"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertSame(Display::$PAGE, $obj->getDisplay());
    }


    public function testFromJsonDisplayValidNull()
    {
        $json = '{"display":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getDisplay());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDisplayInvalidBool()
    {
        $json = '{"display":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDisplayInvalidNumber()
    {
        $json = '{"display":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDisplayInvalidArray()
    {
        $json = '{"display":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonDisplayInvalidObject()
    {
        $json = '{"display":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonMaxAgeValidInt()
    {
        $json = '{"maxAge":1}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(1, $obj->getMaxAge());
    }


    public function testFromJsonMaxAgeValidStr()
    {
        $json = '{"maxAge":"2"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals("2", $obj->getMaxAge());
    }


    public function testFromJsonMaxAgeValidNull()
    {
        $json = '{"maxAge":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getMaxAge());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonMaxAgeInvalidBool()
    {
        $json = '{"maxAge":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonMaxAgeInvalidArray()
    {
        $json = '{"maxAge":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonMaxAgeInvalidObject()
    {
        $json = '{"maxAge":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonScopesValidValue()
    {
        $json = '{"scopes":[{"name":"scope0"}]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $scopes = $obj->getScopes();

        $this->assertTrue(is_array($scopes));
        $this->assertCount(1, $scopes);

        $scope = $scopes[0];

        $this->assertInstanceOf('\Authlete\Dto\Scope', $scope);
        $this->assertEquals('scope0', $scope->getName());
    }


    public function testFromJsonScopesValidNull()
    {
        $json = '{"scopes":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getScopes());
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidBool()
    {
        $json = '{"scopes":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidNumber()
    {
        $json = '{"scopes":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidArray()
    {
        $json = '{"scopes":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonScopesInvalidObject()
    {
        $json = '{"scopes":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonUiLocalesValidValue()
    {
        $json = '{"uiLocales":["en","ja"]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $locales = $obj->getUiLocales();

        $this->assertTrue(is_array($locales));
        $this->assertCount(2, $locales);
        $this->assertEquals('en', $locales[0]);
        $this->assertEquals('ja', $locales[1]);
    }


    public function testFromJsonUiLocalesValidNull()
    {
        $json = '{"uiLocales":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getUiLocales());
    }


    /** @expectedException Error */
    public function testFromJsonUiLocalesInvalidBool()
    {
        $json = '{"uiLocales":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonUiLocalesInvalidNumber()
    {
        $json = '{"uiLocales":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonClaimsLocalesValidValue()
    {
        $json = '{"claimsLocales":["en","ja"]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $locales = $obj->getClaimsLocales();

        $this->assertTrue(is_array($locales));
        $this->assertCount(2, $locales);
        $this->assertEquals('en', $locales[0]);
        $this->assertEquals('ja', $locales[1]);
    }


    public function testFromJsonClaimsLocalesValidNull()
    {
        $json = '{"claimsLocales":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getClaimsLocales());
    }


    /** @expectedException Error */
    public function testFromJsonClaimsLocalesInvalidBool()
    {
        $json = '{"claimsLocales":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClaimsLocalesInvalidNumber()
    {
        $json = '{"claimsLocales":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonClaimsValidValue()
    {
        $json = '{"claims":["name","email"]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $claims = $obj->getClaims();

        $this->assertTrue(is_array($claims));
        $this->assertCount(2, $claims);
        $this->assertEquals('name',  $claims[0]);
        $this->assertEquals('email', $claims[1]);
    }


    public function testFromJsonClaimsValidNull()
    {
        $json = '{"claims":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getClaims());
    }


    /** @expectedException Error */
    public function testFromJsonClaimsInvalidBool()
    {
        $json = '{"claims":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonClaimsInvalidNumber()
    {
        $json = '{"claims":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonAcrEssentialValidValue()
    {
        $json = '{"acrEssential":true}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(true, $obj->isAcrEssential());
    }


    public function testFromJsonAcrEssentialValidNull()
    {
        $json = '{"acrEssential":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isAcrEssential());
    }


    public function testFromJsonAcrEssentialStringTrue()
    {
        $json = '{"acrEssential":"true"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(true, $obj->isAcrEssential());
    }


    public function testFromJsonCAcrEssentialValidStringFalse()
    {
        $json = '{"acrEssential":"false"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isAcrEssential());
    }


    public function testFromJsonAcrEssentialInvalidString()
    {
        $json = '{"acrEssential":"__INVALID__"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals(false, $obj->isAcrEssential());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonAcrEssentialInvalidType()
    {
        $json = '{"acrEssential":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonAcrsValidValue()
    {
        $json = '{"acrs":["acr0","acr1"]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $acrs = $obj->getAcrs();

        $this->assertTrue(is_array($acrs));
        $this->assertCount(2, $acrs);
        $this->assertEquals('acr0', $acrs[0]);
        $this->assertEquals('acr1', $acrs[1]);
    }


    public function testFromJsonAcrsValidNull()
    {
        $json = '{"acrs":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getAcrs());
    }


    /** @expectedException Error */
    public function testFromJsonAcrsInvalidBool()
    {
        $json = '{"acrs":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonAcrsInvalidNumber()
    {
        $json = '{"acrs":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonSubjectValidValue()
    {
        $json = '{"subject":"_subject_"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('_subject_', $obj->getSubject());
    }


    public function testFromJsonSubjectValidNull()
    {
        $json = '{"subject":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getSubject());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidBool()
    {
        $json = '{"subject":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidNumber()
    {
        $json = '{"subject":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidArray()
    {
        $json = '{"subject":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonSubjectInvalidObject()
    {
        $json = '{"subject":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonLoginHintValidValue()
    {
        $json = '{"loginHint":"hint"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('hint', $obj->getLoginHint());
    }


    public function testFromJsonLoginHintValidNull()
    {
        $json = '{"loginHint":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getLoginHint());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLoginHintInvalidBool()
    {
        $json = '{"loginHint":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLoginHintInvalidNumber()
    {
        $json = '{"loginHint":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLoginHintInvalidArray()
    {
        $json = '{"loginHint":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLoginHintInvalidObject()
    {
        $json = '{"loginHint":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonPromptsValidValue()
    {
        $json = '{"prompts":["NONE","LOGIN"]}';
        $obj  = AuthorizationResponse::fromJson($json);

        $prompts = $obj->getPrompts();

        $this->assertTrue(is_array($prompts));
        $this->assertCount(2, $prompts);
        $this->assertEquals(Prompt::$NONE,  $prompts[0]);
        $this->assertEquals(Prompt::$LOGIN, $prompts[1]);
    }


    public function testFromJsonPromptsValidNull()
    {
        $json = '{"prompts":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getPrompts());
    }


    /** @expectedException Error */
    public function testFromJsonPromptsInvalidBool()
    {
        $json = '{"prompts":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPromptsInvalidNumber()
    {
        $json = '{"prompts":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException Error */
    public function testFromJsonPromptsInvalidString()
    {
        $json = '{"prompts":"__INVALID__"}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPromptsInvalidElement()
    {
        $json = '{"prompts":["__INVALID__"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonResponseContentValidValue()
    {
        $json = '{"responseContent":"content"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('content', $obj->getResponseContent());
    }


    public function testFromJsonResponseContentValidNull()
    {
        $json = '{"responseContent":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getResponseContent());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidBool()
    {
        $json = '{"responseContent":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidNumber()
    {
        $json = '{"responseContent":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidArray()
    {
        $json = '{"responseContent":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidObject()
    {
        $json = '{"responseContent":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testFromJsonTicketValidValue()
    {
        $json = '{"ticket":"_ticket_"}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertEquals('_ticket_', $obj->getTicket());
    }


    public function testFromJsonTicketValidNull()
    {
        $json = '{"ticket":null}';
        $obj  = AuthorizationResponse::fromJson($json);

        $this->assertNull($obj->getTicket());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidBool()
    {
        $json = '{"ticket":true}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidNumber()
    {
        $json = '{"ticket":123}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidArray()
    {
        $json = '{"ticket":["a","b"]}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonTicketInvalidObject()
    {
        $json = '{"ticket":{"a":"b"}}';
        $obj  = AuthorizationResponse::fromJson($json);
    }


    public function testToJson()
    {
        $service       = (new Service())->setServiceName('MyService');
        $client        = (new Client())->setClientName('MyClient');
        $scopes        = array((new Scope())->setName('scope0'));
        $uiLocales     = array('en', 'ja');
        $claimsLocales = array('en', 'ja');
        $claims        = array('name', 'email');
        $acrs          = array('acr0', 'acr1');
        $prompts       = array(Prompt::$NONE, Prompt::$LOGIN);

        $obj = new AuthorizationResponse();
        $obj->setResultCode('code')
            ->setResultMessage('message')
            ->setAction(AuthorizationAction::$INTERACTION)
            ->setService($service)
            ->setClient($client)
            ->setClientIdAliasUsed(true)
            ->setDisplay(Display::$PAGE)
            ->setMaxAge(1)
            ->setScopes($scopes)
            ->setUiLocales($uiLocales)
            ->setClaimsLocales($claimsLocales)
            ->setClaims($claims)
            ->setAcrEssential(true)
            ->setAcrs($acrs)
            ->setSubject('_subject_')
            ->setLoginHint('hint')
            ->setPrompts($prompts)
            ->setResponseContent('content')
            ->setTicket('_ticket_')
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // resultCode
        $this->assertArrayHasKey('resultCode', $array);
        $this->assertEquals('code', $array['resultCode']);

        // resultMessage
        $this->assertArrayHasKey('resultMessage', $array);
        $this->assertEquals('message', $array['resultMessage']);

        // action
        $this->assertArrayHasKey('action', $array);
        $this->assertEquals('INTERACTION', $array['action']);

        // service
        $this->assertArrayHasKey('service', $array);
        $this->assertTrue(is_array($array['service']));
        $this->assertArrayHasKey('serviceName', $array['service']);

        // client
        $this->assertArrayHasKey('client', $array);
        $this->assertTrue(is_array($array['client']));
        $this->assertArrayHasKey('clientName', $array['client']);

        // clientIdAliasUsed
        $this->assertArrayHasKey('clientIdAliasUsed', $array);
        $this->assertEquals(true, $array['clientIdAliasUsed']);

        // display
        $this->assertArrayHasKey('display', $array);
        $this->assertEquals('PAGE', $array['display']);

        // maxAge
        $this->assertArrayHasKey('maxAge', $array);
        $this->assertEquals(1, $array['maxAge']);

        // scopes
        $this->assertArrayHasKey('scopes', $array);
        $this->assertTrue(is_array($array['scopes']));
        $this->assertTrue(is_array($array['scopes'][0]));
        $this->assertArrayHasKey('name', $array['scopes'][0]);

        // uiLocales
        $this->assertArrayHasKey('uiLocales', $array);
        $this->assertTrue(is_array($array['uiLocales']));
        $this->assertEquals('en', $array['uiLocales'][0]);
        $this->assertEquals('ja', $array['uiLocales'][1]);

        // claimsLocales
        $this->assertArrayHasKey('claimsLocales', $array);
        $this->assertTrue(is_array($array['claimsLocales']));
        $this->assertEquals('en', $array['claimsLocales'][0]);
        $this->assertEquals('ja', $array['claimsLocales'][1]);

        // claims
        $this->assertArrayHasKey('claims', $array);
        $this->assertTrue(is_array($array['claims']));
        $this->assertEquals('name',  $array['claims'][0]);
        $this->assertEquals('email', $array['claims'][1]);

        // acrEssential
        $this->assertArrayHasKey('acrEssential', $array);
        $this->assertEquals(true, $array['acrEssential']);

        // acrs
        $this->assertArrayHasKey('acrs', $array);
        $this->assertTrue(is_array($array['acrs']));
        $this->assertEquals('acr0', $array['acrs'][0]);
        $this->assertEquals('acr1', $array['acrs'][1]);

        // subject
        $this->assertArrayHasKey('subject', $array);
        $this->assertEquals('_subject_', $array['subject']);

        // loginHint
        $this->assertArrayHasKey('loginHint', $array);
        $this->assertEquals('hint', $array['loginHint']);

        // prompts
        $this->assertArrayHasKey('prompts', $array);
        $this->assertTrue(is_array($array['prompts']));
        $this->assertEquals('NONE',  $array['prompts'][0]);
        $this->assertEquals('LOGIN', $array['prompts'][1]);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals('content', $array['responseContent']);

        // ticket
        $this->assertArrayHasKey('ticket', $array);
        $this->assertEquals('_ticket_', $array['ticket']);
    }
}
?>
