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
use Authlete\Types\UserIdentificationHintType;


class UserIdentificationHintTypeTest extends TestCase
{
    public function testNameOfIdTokenHint()
    {
        $obj = UserIdentificationHintType::$ID_TOKEN_HINT;

        $this->assertEquals('ID_TOKEN_HINT', $obj->name());
    }


    public function testValueOfIdTokenHint()
    {
        $obj = UserIdentificationHintType::$ID_TOKEN_HINT;

        $this->assertSame($obj, UserIdentificationHintType::valueOf($obj));
        $this->assertSame($obj, UserIdentificationHintType::valueOf('ID_TOKEN_HINT'));
    }


    public function testNameOfLoginHint()
    {
        $obj = UserIdentificationHintType::$LOGIN_HINT;

        $this->assertEquals('LOGIN_HINT', $obj->name());
    }


    public function testValueOfLoginHint()
    {
        $obj = UserIdentificationHintType::$LOGIN_HINT;

        $this->assertSame($obj, UserIdentificationHintType::valueOf($obj));
        $this->assertSame($obj, UserIdentificationHintType::valueOf('LOGIN_HINT'));
    }


    public function testNameOfLoginHintToken()
    {
        $obj = UserIdentificationHintType::$LOGIN_HINT_TOKEN;

        $this->assertEquals('LOGIN_HINT_TOKEN', $obj->name());
    }


    public function testValueOfLoginHintToken()
    {
        $obj = UserIdentificationHintType::$LOGIN_HINT_TOKEN;

        $this->assertSame($obj, UserIdentificationHintType::valueOf($obj));
        $this->assertSame($obj, UserIdentificationHintType::valueOf('LOGIN_HINT_TOKEN'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(UserIdentificationHintType::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        UserIdentificationHintType::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        UserIdentificationHintType::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new UserIdentificationHintType('NEW');
    }
}
?>
