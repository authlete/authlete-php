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


namespace Authlete\Tests\Types;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Types\ClientType;


class ClientTypeTest extends TestCase
{
    public function testNameOfPublic()
    {
        $obj = ClientType::$PUBLIC;

        $this->assertEquals('PUBLIC', $obj->name());
    }


    public function testValueOfPubli()
    {
        $obj = ClientType::$PUBLIC;

        $this->assertSame($obj, ClientType::valueOf($obj));
        $this->assertSame($obj, ClientType::valueOf('PUBLIC'));
    }


    public function testNameOfConfidential()
    {
        $obj = ClientType::$CONFIDENTIAL;

        $this->assertEquals('CONFIDENTIAL', $obj->name());
    }


    public function testValueOfConfidential()
    {
        $obj = ClientType::$CONFIDENTIAL;

        $this->assertSame($obj, ClientType::valueOf($obj));
        $this->assertSame($obj, ClientType::valueOf('CONFIDENTIAL'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(ClientType::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        ClientType::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        ClientType::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new ClientType('NEW');
    }
}
?>
