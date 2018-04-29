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


namespace Authlete\Tests\Web;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Web\HttpMethod;


class HttpMethodTest extends TestCase
{
    public function testNameOfGET()
    {
        $obj = HttpMethod::$GET;

        $this->assertEquals('GET', $obj->name());
    }


    public function testValueOfGET()
    {
        $obj = HttpMethod::$GET;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('GET'));
    }


    public function testNameOfHEAD()
    {
        $obj = HttpMethod::$HEAD;

        $this->assertEquals('HEAD', $obj->name());
    }


    public function testValueOfHEAD()
    {
        $obj = HttpMethod::$HEAD;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('HEAD'));
    }


    public function testNameOfPOST()
    {
        $obj = HttpMethod::$POST;

        $this->assertEquals('POST', $obj->name());
    }


    public function testValueOfPOST()
    {
        $obj = HttpMethod::$POST;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('POST'));
    }


    public function testNameOfPUT()
    {
        $obj = HttpMethod::$PUT;

        $this->assertEquals('PUT', $obj->name());
    }


    public function testValueOfPUT()
    {
        $obj = HttpMethod::$PUT;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('PUT'));
    }


    public function testNameOfDELETE()
    {
        $obj = HttpMethod::$DELETE;

        $this->assertEquals('DELETE', $obj->name());
    }


    public function testValueOfDELETE()
    {
        $obj = HttpMethod::$DELETE;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('DELETE'));
    }


    public function testNameOfCONNECT()
    {
        $obj = HttpMethod::$CONNECT;

        $this->assertEquals('CONNECT', $obj->name());
    }


    public function testValueOfCONNECT()
    {
        $obj = HttpMethod::$CONNECT;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('CONNECT'));
    }


    public function testNameOfOPTIONS()
    {
        $obj = HttpMethod::$OPTIONS;

        $this->assertEquals('OPTIONS', $obj->name());
    }


    public function testValueOfOPTIONS()
    {
        $obj = HttpMethod::$OPTIONS;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('OPTIONS'));
    }


    public function testNameOfTRACE()
    {
        $obj = HttpMethod::$TRACE;

        $this->assertEquals('TRACE', $obj->name());
    }


    public function testValueOfTRACE()
    {
        $obj = HttpMethod::$TRACE;

        $this->assertSame($obj, HttpMethod::valueOf($obj));
        $this->assertSame($obj, HttpMethod::valueOf('TRACE'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(HttpMethod::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        HttpMethod::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        HttpMethod::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new HttpMethod('NEW');
    }
}
?>
