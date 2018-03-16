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
use Authlete\Types\CodeChallengeMethod;


class CodeChallengeMethodTest extends TestCase
{
    public function testNameOfPlain()
    {
        $obj = CodeChallengeMethod::$PLAIN;

        $this->assertEquals('PLAIN', $obj->name());
    }


    public function testValueOfPlain()
    {
        $obj = CodeChallengeMethod::$PLAIN;

        $this->assertSame($obj, CodeChallengeMethod::valueOf($obj));
        $this->assertSame($obj, CodeChallengeMethod::valueOf('PLAIN'));
    }


    public function testNameOfS256()
    {
        $obj = CodeChallengeMethod::$S256;

        $this->assertEquals('S256', $obj->name());
    }


    public function testValueOfS256()
    {
        $obj = CodeChallengeMethod::$S256;

        $this->assertSame($obj, CodeChallengeMethod::valueOf($obj));
        $this->assertSame($obj, CodeChallengeMethod::valueOf('S256'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(CodeChallengeMethod::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        CodeChallengeMethod::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        CodeChallengeMethod::valueOf(array());
    }


    /** @expectedException Error */
    public function testInstantiation()
    {
        new CodeChallengeMethod('NEW');
    }
}
?>
