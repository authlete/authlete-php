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



use Authlete\Dto\ApiResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class ApiResponseTest extends TestCase
{
    public function testResultCodeValidValue()
    {
        $obj = new ApiResponse();

        $resultCode = "code";
        $obj->setResultCode($resultCode);

        $this->assertEquals($resultCode, $obj->getResultCode());
    }


    public function testResultCodeValidNull()
    {
        $obj = new ApiResponse();
        $obj->setResultCode(null);

        $this->assertNull($obj->getResultCode());
    }


    public function testResultCodeInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testResultMessageInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testFromJsonResultCodeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":true}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultCode":["a","b"]}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testFromJsonResultCodeInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
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


    public function testFromJsonResultMessageInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":true}';
        $obj  = ApiResponse::fromJson($json);
        $this->assertNull($obj);
    }


    public function testFromJsonResultMessageInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":123}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"resultMessage":["a","b"]}';
        $obj  = ApiResponse::fromJson($json);
    }


    public function testFromJsonResultMessageInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
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
