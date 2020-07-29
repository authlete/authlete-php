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


namespace Authlete\Tests\Types;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Types\UserCodeCharset;


class UserCodeCharsetTest extends TestCase
{
    public function testNameOfBase20()
    {
        $obj = UserCodeCharset::$BASE20;

        $this->assertEquals('BASE20', $obj->name());
    }


    public function testValueOfBase20()
    {
        $obj = UserCodeCharset::$BASE20;

        $this->assertSame($obj, UserCodeCharset::valueOf($obj));
        $this->assertSame($obj, UserCodeCharset::valueOf('BASE20'));
    }


    public function testNameOfNumeric()
    {
        $obj = UserCodeCharset::$NUMERIC;

        $this->assertEquals('NUMERIC', $obj->name());
    }


    public function testValueOfNumeric()
    {
        $obj = UserCodeCharset::$NUMERIC;

        $this->assertSame($obj, UserCodeCharset::valueOf($obj));
        $this->assertSame($obj, UserCodeCharset::valueOf('NUMERIC'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(UserCodeCharset::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        UserCodeCharset::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        UserCodeCharset::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new UserCodeCharset('NEW');
    }
}
?>
