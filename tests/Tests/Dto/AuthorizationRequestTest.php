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


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Authlete\Dto\AuthorizationRequest;


class AuthorizationRequestTest extends TestCase
{
    private const PARAMETERS = '_parameters_';


    public function testParametersValidValue()
    {
        $obj = new AuthorizationRequest();
        $obj->setParameters(self::PARAMETERS);

        $this->assertEquals(self::PARAMETERS, $obj->getParameters());
    }


    public function testParametersValidNull()
    {
        $obj = new AuthorizationRequest();
        $obj->setParameters(null);

        $this->assertNull($obj->getParameters());
    }


    public function testParametersInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new AuthorizationRequest();

        $invalid = array();
        $obj->setParameters($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = AuthorizationRequest::fromJson($json);

        $this->assertInstanceof(AuthorizationRequest::class, $obj);
    }


    public function testFromJsonTicketValidValue()
    {
        $json = '{"parameters":"' . self::PARAMETERS . '"}';
        $obj  = AuthorizationRequest::fromJson($json);

        $this->assertEquals(self::PARAMETERS, $obj->getParameters());
    }


    public function testFromJsonParametersValidNull()
    {
        $json = '{"parameters":null}';
        $obj  = AuthorizationRequest::fromJson($json);

        $this->assertNull($obj->getParameters());
    }


    public function testFromJsonParametersInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":true}';
        $obj  = AuthorizationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":123}';
        $obj  = AuthorizationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":["a","b"]}';
        $obj  = AuthorizationRequest::fromJson($json);
    }


    public function testFromJsonParametersInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"parameters":{"a":"b"}}';
        $obj  = AuthorizationRequest::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new AuthorizationRequest();
        $obj->setParameters(self::PARAMETERS);

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // parameters
        $this->assertArrayHasKey('parameters', $array);
        $this->assertEquals(self::PARAMETERS, $array['parameters']);
    }
}

