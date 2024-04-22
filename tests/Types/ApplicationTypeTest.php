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


namespace Tests\Types;



use Error;
use InvalidArgumentException;
use Authlete\Types\ApplicationType;
use PHPUnit\Framework\TestCase;


class ApplicationTypeTest extends TestCase
{
    public function testNameOfWeb()
    {
        $obj = ApplicationType::WEB;

        $this->assertEquals('WEB', $obj->name);
    }


    public function testValueOfWeb()
    {
        $obj = ApplicationType::WEB;

        $this->assertSame($obj, ApplicationType::valueOf($obj->value));
        $this->assertSame($obj, ApplicationType::valueOf('WEB'));
    }


    public function testNameOfNative()
    {
        $obj = ApplicationType::NATIVE;

        $this->assertEquals('NATIVE', $obj->name);
    }


    public function testValueOfNative()
    {
        $obj = ApplicationType::NATIVE;

        $this->assertSame($obj, ApplicationType::valueOf($obj->value));
        $this->assertSame($obj, ApplicationType::valueOf('NATIVE'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(ApplicationType::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        ApplicationType::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        ApplicationType::valueOf(array());
    }


    public function testInstantiation()
    {
        $this->expectException(InvalidArgumentException::class);
        ApplicationType::valueOf("NEW");
    }
}
