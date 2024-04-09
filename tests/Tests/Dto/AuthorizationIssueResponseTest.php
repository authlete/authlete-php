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


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Authlete\Dto\AuthorizationIssueAction;
use Authlete\Dto\AuthorizationIssueResponse;


class AuthorizationIssueResponseTest extends TestCase
{
    public function testResultCodeValidValue()
    {
        $obj = new AuthorizationIssueResponse();

        $resultCode = 'code';
        $obj->setResultCode($resultCode);

        $this->assertEquals($resultCode, $obj->getResultCode());
    }


    public function testResultCodeValidNull()
    {
        $obj = new AuthorizationIssueResponse();
        $obj->setResultCode(null);

        $this->assertNull($obj->getResultCode());
    }


    public function testResultCodeInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationIssueResponse();

        $invalid = array();
        $obj->setResultCode($invalid);
    }


    public function testResultMessageValidValue()
    {
        $obj = new AuthorizationIssueResponse();

        $resultMessage = 'message';
        $obj->setResultMessage($resultMessage);

        $this->assertEquals($resultMessage, $obj->getResultMessage());
    }


    public function testResultMessageValidNull()
    {
        $obj = new AuthorizationIssueResponse();
        $obj->setResultMessage(null);

        $this->assertNull($obj->getResultMessage());
    }


    public function testResultMessageInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationIssueResponse();

        $invalid = array();
        $obj->setResultMessage($invalid);
    }


    public function testActionValidValue()
    {
        $obj = new AuthorizationIssueResponse();

        $action = AuthorizationIssueAction::$LOCATION;
        $obj->setAction($action);

        $this->assertSame($action, $obj->getAction());
    }


    public function testActionValidNull()
    {
        $obj = new AuthorizationIssueResponse();
        $obj->setAction(null);

        $this->assertNull($obj->getAction());
    }


    public function testResponseContentValidValue()
    {
        $obj = new AuthorizationIssueResponse();

        $responseContent = 'content';
        $obj->setResponseContent($responseContent);

        $this->assertEquals($responseContent, $obj->getResponseContent());
    }


    public function testResponseContentValidNull()
    {
        $obj = new AuthorizationIssueResponse();
        $obj->setResponseContent(null);

        $this->assertNull($obj->getResponseContent());
    }


    public function testResponseContentInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationIssueResponse();

        $invalid = array();
        $obj->setResponseContent($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertInstanceof(AuthorizationIssueResponse::class, $obj);
    }


    public function testFromJsonResultCodeValidValue()
    {
        $json = '{"resultCode":"code"}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertEquals('code', $obj->getResultCode());
    }


    public function testFromJsonResultCodeValidNull()
    {
        $json = '{"resultCode":null}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertNull($obj->getResultCode());
    }


    public function testFromJsonResultCodeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":true}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":123}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":["a","b"]}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":{"a":"b"}}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultMessageValidValue()
    {
        $json = '{"resultMessage":"message"}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertEquals('message', $obj->getResultMessage());
    }


    public function testFromJsonResultMessageValidNull()
    {
        $json = '{"resultMessage":null}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertNull($obj->getResultMessage());
    }


    public function testFromJsonResultMessageInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":true}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":123}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":["a","b"]}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":{"a":"b"}}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonActionValidValue()
    {
        $json = '{"action":"LOCATION"}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertSame(AuthorizationIssueAction::$LOCATION, $obj->getAction());
    }


    public function testFromJsonActionValidNull()
    {
        $json = '{"action":null}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertNull($obj->getAction());
    }


    public function testFromJsonActionInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":true}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":123}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":["a","b"]}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":{"a":"b"}}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResponseContentValidValue()
    {
        $json = '{"responseContent":"content"}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertEquals('content', $obj->getResponseContent());
    }


    public function testFromJsonResponseContentValidNull()
    {
        $json = '{"responseContent":null}';
        $obj  = AuthorizationIssueResponse::fromJson($json);

        $this->assertNull($obj->getResponseContent());
    }


    public function testFromJsonResponseContentInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":true}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":123}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":["a","b"]}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":{"a":"b"}}';
        $obj  = AuthorizationIssueResponse::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new AuthorizationIssueResponse();
        $obj->setResultCode('code')
            ->setResultMessage('message')
            ->setAction(AuthorizationIssueAction::$LOCATION)
            ->setResponseContent('content')
            ->setAccessToken('access_token')
            ->setAccessTokenExpiresAt(12345)
            ->setAccessTokenDuration(67890)
            ->setIdToken('id_token')
            ->setAuthorizationCode('authorization_code')
            ->setJwtAccessToken('jwt_access_token')
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
        $this->assertSame('LOCATION', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals('content', $array['responseContent']);

        // accessToken
        $this->assertArrayHasKey('accessToken', $array);
        $this->assertEquals('access_token', $array['accessToken']);

        // accessTokenExpiresAt
        $this->assertArrayHasKey('accessTokenExpiresAt', $array);
        $this->assertEquals(12345, $array['accessTokenExpiresAt']);

        // accessTokenDuration
        $this->assertArrayHasKey('accessTokenDuration', $array);
        $this->assertEquals(67890, $array['accessTokenDuration']);

        // idToken
        $this->assertArrayHasKey('idToken', $array);
        $this->assertEquals('id_token', $array['idToken']);

        // authorizationCode
        $this->assertArrayHasKey('authorizationCode', $array);
        $this->assertEquals('authorization_code', $array['authorizationCode']);

        // jwtAccessToken
        $this->assertArrayHasKey('jwtAccessToken', $array);
        $this->assertEquals('jwt_access_token', $array['jwtAccessToken']);
    }
}

