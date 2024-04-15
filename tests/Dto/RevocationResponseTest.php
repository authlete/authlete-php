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


namespace Tests\Dto;



use Authlete\Dto\RevocationAction;
use Authlete\Dto\RevocationResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class RevocationResponseTest extends TestCase
{
    public function testResultCodeValidValue()
    {
        $obj = new RevocationResponse();

        $resultCode = 'code';
        $obj->setResultCode($resultCode);

        $this->assertEquals($resultCode, $obj->getResultCode());
    }


    public function testResultCodeValidNull()
    {
        $obj = new RevocationResponse();
        $obj->setResultCode(null);

        $this->assertNull($obj->getResultCode());
    }


    public function testResultCodeInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationResponse();

        $invalid = array();
        $obj->setResultCode($invalid);
    }


    public function testResultMessageValidValue()
    {
        $obj = new RevocationResponse();

        $resultMessage = 'message';
        $obj->setResultMessage($resultMessage);

        $this->assertEquals($resultMessage, $obj->getResultMessage());
    }


    public function testResultMessageValidNull()
    {
        $obj = new RevocationResponse();
        $obj->setResultMessage(null);

        $this->assertNull($obj->getResultMessage());
    }


    public function testResultMessageInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationResponse();

        $invalid = array();
        $obj->setResultMessage($invalid);
    }


    public function testActionValidValue()
    {
        $obj = new RevocationResponse();

        $action = RevocationAction::OK;
        $obj->setAction($action);

        $this->assertSame($action, $obj->getAction());
    }


    public function testActionValidNull()
    {
        $obj = new RevocationResponse();
        $obj->setAction(null);

        $this->assertNull($obj->getAction());
    }


    public function testResponseContentValidValue()
    {
        $obj = new RevocationResponse();

        $responseContent = 'content';
        $obj->setResponseContent($responseContent);

        $this->assertEquals($responseContent, $obj->getResponseContent());
    }


    public function testResponseContentValidNull()
    {
        $obj = new RevocationResponse();
        $obj->setResponseContent(null);

        $this->assertNull($obj->getResponseContent());
    }


    public function testResponseContentInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new RevocationResponse();

        $invalid = array();
        $obj->setResponseContent($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertInstanceof(RevocationResponse::class, $obj);
    }


    public function testFromJsonResultCodeValidValue()
    {
        $json = '{"resultCode":"code"}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertEquals('code', $obj->getResultCode());
    }


    public function testFromJsonResultCodeValidNull()
    {
        $json = '{"resultCode":null}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertNull($obj->getResultCode());
    }


    public function testFromJsonResultCodeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultMessageValidValue()
    {
        $json = '{"resultMessage":"message"}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertEquals('message', $obj->getResultMessage());
    }


    public function testFromJsonResultMessageValidNull()
    {
        $json = '{"resultMessage":null}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertNull($obj->getResultMessage());
    }


    public function testFromJsonResultMessageInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonActionValidValue()
    {
        $json = '{"action":"OK"}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertSame(RevocationAction::OK, $obj->getAction());
    }


    public function testFromJsonActionValidNull()
    {
        $json = '{"action":null}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertNull($obj->getAction());
    }


    public function testFromJsonActionInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"action":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidArray()
    {
        $this->expectException(\TypeError::class);
        $json = '{"action":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonActionInvalidObject()
    {
        $this->expectException(\TypeError::class);
        $json = '{"action":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResponseContentValidValue()
    {
        $json = '{"responseContent":"content"}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertEquals('content', $obj->getResponseContent());
    }


    public function testFromJsonResponseContentValidNull()
    {
        $json = '{"responseContent":null}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertNull($obj->getResponseContent());
    }


    public function testFromJsonResponseContentInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonResponseContentInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"responseContent":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new RevocationResponse();
        $obj->setResultCode('code')
            ->setResultMessage('message')
            ->setAction(RevocationAction::OK)
            ->setResponseContent('content')
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
        $this->assertSame('OK', $array['action']);

        // responseContent
        $this->assertArrayHasKey('responseContent', $array);
        $this->assertEquals('content', $array['responseContent']);
    }
}
