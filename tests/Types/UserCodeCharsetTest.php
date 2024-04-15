<?php
//
// Copyright (C) 2020 Authlete, Inc.
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



use InvalidArgumentException;
use Authlete\Types\UserCodeCharset;
use PHPUnit\Framework\TestCase;


class UserCodeCharsetTest extends TestCase
{
    public function testNameOfBase20()
    {
        $obj = UserCodeCharset::BASE20;

        $this->assertEquals('BASE20', $obj->name);
    }


    public function testValueOfBase20()
    {
        $obj = UserCodeCharset::BASE20;

        $this->assertSame($obj, UserCodeCharset::valueOf($obj->value));
        $this->assertSame($obj, UserCodeCharset::valueOf('BASE20'));
    }


    public function testNameOfNumeric()
    {
        $obj = UserCodeCharset::NUMERIC;

        $this->assertEquals('NUMERIC', $obj->name);
    }


    public function testValueOfNumeric()
    {
        $obj = UserCodeCharset::NUMERIC;

        $this->assertSame($obj, UserCodeCharset::valueOf($obj->value));
        $this->assertSame($obj, UserCodeCharset::valueOf('NUMERIC'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(UserCodeCharset::valueOf(null));
    }


    public function testValueOfInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        UserCodeCharset::valueOf('__INVALID_VALUE__');
    }


    public function testValueOfInvalidArray()
    {
        $this->expectException(\TypeError::class);
        UserCodeCharset::valueOf(array());
    }


    public function testInstantiation()
    {
        $this->expectException(InvalidArgumentException::class);
        UserCodeCharset::valueOf('NEW');
    }
}
