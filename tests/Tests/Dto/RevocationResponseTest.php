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
use Authlete\Dto\RevocationAction;
use Authlete\Dto\RevocationResponse;


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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testResultCodeInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testResultMessageInvalidValue()
    {
        $obj = new RevocationResponse();

        $invalid = array();
        $obj->setResultMessage($invalid);
    }


    public function testActionValidValue()
    {
        $obj = new RevocationResponse();

        $action = RevocationAction::$OK;
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


    /** @expectedException InvalidArgumentException */
    public function testResponseContentInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidBool()
    {
        $json = '{"resultCode":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidNumber()
    {
        $json = '{"resultCode":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidArray()
    {
        $json = '{"resultCode":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidBool()
    {
        $json = '{"resultMessage":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidNumber()
    {
        $json = '{"resultMessage":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidArray()
    {
        $json = '{"resultMessage":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidObject()
    {
        $json = '{"resultMessage":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testFromJsonActionValidValue()
    {
        $json = '{"action":"OK"}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertSame(RevocationAction::$OK, $obj->getAction());
    }


    public function testFromJsonActionValidNull()
    {
        $json = '{"action":null}';
        $obj  = RevocationResponse::fromJson($json);

        $this->assertNull($obj->getAction());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidBool()
    {
        $json = '{"action":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidNumber()
    {
        $json = '{"action":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidArray()
    {
        $json = '{"action":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonActionInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidBool()
    {
        $json = '{"responseContent":true}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidNumber()
    {
        $json = '{"responseContent":123}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidArray()
    {
        $json = '{"responseContent":["a","b"]}';
        $obj  = RevocationResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResponseContentInvalidObject()
    {
        $json = '{"responseContent":{"a":"b"}}';
        $obj  = RevocationResponse::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new RevocationResponse();
        $obj->setResultCode('code')
            ->setResultMessage('message')
            ->setAction(RevocationAction::$OK)
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
?>
