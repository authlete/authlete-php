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
use Authlete\Dto\ApiResponse;


class ApiResponseTest extends TestCase
{
    public function testResultCodeValidValue()
    {
        $obj = new ApiResponse();

        $resultCode = 'code';
        $obj->setResultCode($resultCode);

        $this->assertEquals($resultCode, $obj->getResultCode());
    }


    public function testResultCodeValidNull()
    {
        $obj = new ApiResponse();
        $obj->setResultCode(null);

        $this->assertNull($obj->getResultCode());
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testResultCodeInvalidValue()
    {
        $obj = new ApiResponse();

        $invalid = array();
        $obj->setResultCode($invalid);
    }


    public function testResultMessageValidValue()
    {
        $obj = new ApiResponse();

        $resultMessage = 'message';
        $obj->setResultMessage($resultMessage);

        $this->assertEquals($resultMessage, $obj->getResultMessage());
    }


    public function testResultMessageValidNull()
    {
        $obj = new ApiResponse();
        $obj->setResultMessage(null);

        $this->assertNull($obj->getResultMessage());
    }


    /** @expectedException InvalidArgumentException */
    public function testResultMessageInvalidValue()
    {
        $obj = new ApiResponse();

        $invalid = array();
        $obj->setResultMessage($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = ApiResponse::fromJson($json);

        $this->assertInstanceof(ApiResponse::class, $obj);
    }


    public function testFromJsonResultCodeValidValue()
    {
        $json = '{"resultCode":"code"}';
        $obj  = ApiResponse::fromJson($json);

        $this->assertEquals('code', $obj->getResultCode());
    }


    public function testFromJsonResultCodeValidNull()
    {
        $json = '{"resultCode":null}';
        $obj  = ApiResponse::fromJson($json);

        $this->assertNull($obj->getResultCode());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidBool()
    {
        $json = '{"resultCode":true}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidNumber()
    {
        $json = '{"resultCode":123}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidArray()
    {
        $json = '{"resultCode":["a","b"]}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultCodeInvalidObject()
    {
        $json = '{"resultCode":{"a":"b"}}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testFromJsonResultMessageValidValue()
    {
        $json = '{"resultMessage":"message"}';
        $obj  = ApiResponse::fromJson($json);

        $this->assertEquals('message', $obj->getResultMessage());
    }


    public function testFromJsonResultMessageValidNull()
    {
        $json = '{"resultMessage":null}';
        $obj  = ApiResponse::fromJson($json);

        $this->assertNull($obj->getResultMessage());
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidBool()
    {
        $json = '{"resultMessage":true}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidNumber()
    {
        $json = '{"resultMessage":123}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidArray()
    {
        $json = '{"resultMessage":["a","b"]}';
        $obj  = ApiResponse::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonResultMessageInvalidObject()
    {
        $json = '{"resultMessage":{"a":"b"}}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new ApiResponse();
        $obj->setResultCode('code')
            ->setResultMessage('message')
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // resultCode
        $this->assertArrayHasKey('resultCode', $array);
        $this->assertEquals('code', $array['resultCode']);

        // resultMessage
        $this->assertArrayHasKey('resultMessage', $array);
        $this->assertEquals('message', $array['resultMessage']);
    }
}
?>
